<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecongratulationRequest extends FormRequest
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
            "name" => 'required|regex:/^[A-Za-z\'. ]*$/i',
            "alamat" => 'string',
            "pesan" => 'required|string'
        ];
    }
}
