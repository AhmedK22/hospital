<?php

namespace Modules\Doctor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class CreateDoctor extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules =  [
           'department'=>'required',
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:doctors,email,'.Request()->route('doctor').'|max:255',
        
        ];

        if(Request()->route('doctor')==null) {
            $rules['password'] = [
                'required',
                'string',
            ];
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
