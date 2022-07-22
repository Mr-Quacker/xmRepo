<?php

namespace App\Http\Requests;

use App\Services\SymbolsService;
use Illuminate\Foundation\Http\FormRequest;

class formCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'symbol' => ['required','string','in:'.implode(',',(new SymbolsService)->getSymbols())],
            'start-date' => ['required', 'string', 'date_format:"Y-m-d"', 'before:end-date'],
            'end-date' => ['required', 'string', 'date_format:"Y-m-d"', 'before_or_equal:tomorrow'],
            'email' => ['required', 'string', 'email']
        ];
    }
}
