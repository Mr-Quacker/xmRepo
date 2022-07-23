<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\formCreateRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class TableController extends Controller
{
    private string $apiKey;
    private string $host;

    public function __construct()
    {
        $this->apiKey = '10718b34famshe762e0bdd0bbd6ep1af954jsn97161f77d74d';
        $this->host = 'yh-finance.p.rapidapi.com';
    }

    public function index(Request $request)
    {
        $params = $request->input()['data'];
        $data = $this->makeRequest($params['symbol']);

        $prices = array_map(function($item)use($params){
            $date = date('Y-m-d', $item['date']);
            if ($params['start-date'] <= $date
            && $params['end-date'] >= $date)
            {
                return $item;
            }
        },$data['prices']);
        (new EmailService)->sendEmail($params, $prices);
        return View::make('table')->with('data', $prices);
    }

    public function makeRequest($symbol)
    {
        $url = "https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol=$symbol";

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => $this->apiKey,
            'X-RapidAPI-Host' => $this->host
        ])->get($url);
        return $response->json();
    }
}
