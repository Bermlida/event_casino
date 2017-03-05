<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SubmitApplyFormRequest extends Request
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
            'sponsorship_amount' => 'sometimes|integer|min:0',
            'payment_method' => 'sometimes|integer|min:1'
        ];
    }
}
