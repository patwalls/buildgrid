<?php

namespace BuildGrid\Http\Requests;

use BuildGrid\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateNewProjectRequest extends Request
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
            'project_name'         => 'required|min:3',
            'bom_name'             => 'required',
            'supplier.1.name'      => 'required',
            'supplier.1.email'     => 'required|email',
            'supplier.2.name'      => 'required_with:supplier.2.email',
            'supplier.2.email'     => 'required_with:supplier.2.name|email',
            'supplier.3.name'      => 'required_with:supplier.3.email',
            'supplier.3.email'     => 'required_with:supplier.3.name|email',
            'filename'             => 'required'
        ];
    }


}
