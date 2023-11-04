<?php

namespace Modules\Appointment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Appointment\Rules\TimeDiffRule;

class CreateAppointment extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 

        return [
            'doctor_id' => ['required',
            Rule::unique('appointments', 'doctor_id')
            ->where('appointment', $this->input('appointment'))]
            ,
            'appointment' => ['required',  new TimeDiffRule('appointment')],//this rule to avoide dublicate appointments at same time


        ];
    }

    protected function prepareForValidation() {

        if(auth()->check() and !Request()->filled('patient_id')) {

            Request()->merge(['patient_id'=>auth()->id()]);

        }
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
