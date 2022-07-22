<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SymbolsService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\formCreateRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\TableController;

class FormController extends Controller
{

    private array $symbols;
    private string $apiKey;
    private string $host;

    public function __construct()
    {
        $this->symbols = (new SymbolsService())->getSymbols();
        $this->apiKey = '10718b34famshe762e0bdd0bbd6ep1af954jsn97161f77d74d';
        $this->host = 'yh-finance.p.rapidapi.com';
    }

    public function index(Request $request)
    {
        return View::make('form')->with('symbols', $this->symbols);
    }

    // public function submit(Request $request)
    public function submit(formCreateRequest $request)
    {
        // $this->makeRequest($request->validated());

        // $controller = (new TableController($request->validated()));
        // return redirect()->route('table');
        return redirect()->action([TableController::class,'index'], ['data' => $request->validated()]);

    }

    public function makeRequest($data)
    {
        $url = "https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol={$data['symbol']}";

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => $this->apiKey,
            'X-RapidAPI-Host' => $this->host
        ])->get($url);

        return $response->json();
    }
}
