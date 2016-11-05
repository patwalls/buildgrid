<?php

namespace BuildGrid\Http\Requests;

use BuildGrid\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AddAdditionalSuppliersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if( Auth::check() ){
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier.*.name'      => 'required',
            'supplier.*.email'     => 'required|email'
        ];
    }
    /**
     * Attempting to make custom error messages
     * @return array
     */
     public function messages()
     {
         return [
             'supplier.*.name.required' => 'The name is required',
             'supplier.*.email.required' => 'The mail is required'
         ];
     }
    

}






