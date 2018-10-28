<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            'vin' =>'required',
            'model_id' =>'required',
            'bought_price' =>'required',
            'bought_date'  =>'required',
            'sold_currency'=>'required|max:3',
            'bought_currency'=>'required|max:3'
        ];
    }
}
