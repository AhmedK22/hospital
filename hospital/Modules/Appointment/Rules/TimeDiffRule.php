<?php

namespace Modules\Appointment\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Modules\Appointment\Entities\Appointment;

use function PHPSTORM_META\map;

class TimeDiffRule implements Rule
{
    protected $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {


        $inputDateTime = Carbon::parse($value);
        $comparisonDateTime = Appointment::query()->select('appointment')
        ->where('doctor_id', Request()->doctor_id)->get()->toArray();
        $bool = true;
    
        for ($i = 0; $i <   count($comparisonDateTime); $i++) {

            if ($inputDateTime->diffInMinutes(Carbon::parse($comparisonDateTime[$i]['appointment'])) < 60) {
                 $bool = false;
            }
        }

        return $bool;
    }

    public function message()
    {
        return 'The time difference in time must be greater than or equal to 1 hour so take another appointment.';
    }
}
