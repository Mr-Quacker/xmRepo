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

    public function __construct()
    {
        $this->symbols = (new SymbolsService())->getSymbols();
    }

    public function index(Request $request)
    {
        return View::make('form')->with('symbols', $this->symbols);
    }

    public function submit(formCreateRequest $request)
    {
        return redirect()->action([TableController::class,'index'], ['data' => $request->validated()]);

    }
}
