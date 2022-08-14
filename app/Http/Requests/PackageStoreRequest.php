<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageStoreRequest extends FormRequest
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
            'name' => 'required|max:50',
            'short_description' => 'required|max:255',
            'amount' => 'required|numeric',
            'daily_roi' => 'required|numeric',
            'status' => 'required',
            'max_amount' => 'required|numeric',
            'validity_period' => 'required|max:31',
        ];
    }
}
