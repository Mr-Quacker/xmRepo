<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SymbolsService
{

    public function getSymbols(): array
    {
        $symbols_url = 'https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json';
        $response = Http::get($symbols_url)
        // ->body()
        ->json();
        return array_map(function($item) {
            return $item['Symbol'];
        }, $response);
    }

}
