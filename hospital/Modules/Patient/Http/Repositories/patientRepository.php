<?php

namespace Modules\Patient\Http\Repositories;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Appointment\Entities\Appointment;
use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;

class patientRepository extends Controller
{

    public function search(Request $request)
    {
        $patient = Patient::query();

        if($request->filled('id')) {
            $patient->where('id', $request->id);
        }

        return $patient;
    }

    public function fill(Request $request,Patient $patient=null)
    {
      if(!isset($patient)) {
        $patient = new Patient();
      }

      $patient->name = $request->name;
      $patient->email = $request->email;
      $patient->password = Hash::make($request->password);

       $patient->save();

       return $patient;


    }

    public function destroy (Patient $patient)
    {
        return $patient->delete();
    }
}
