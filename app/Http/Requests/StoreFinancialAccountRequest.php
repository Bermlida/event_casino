<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreFinancialAccountRequest extends Request
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
            'financial_institution_code' => 'required|string|max:5',
            'account_number' => 'required|string|max:25'
        ];
    }
}
