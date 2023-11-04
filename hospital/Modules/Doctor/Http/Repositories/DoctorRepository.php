<?php

namespace Modules\Doctor\Http\Repositories;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Appointment\Entities\Appointment;
use Modules\Doctor\Entities\Doctor;

class DoctorRepository extends Controller
{

    public function search(Request $request)
    {
        $doctor = Doctor::query();

        if($request->filled('id')) {
            $doctor->where('id', $request->id);
        }

        return $doctor;
    }

    public function fill(Request $request,Doctor $doctor=null)
    {
      if(!isset($doctor)) {
        $doctor = new Doctor();
      }

      $doctor->name = $request->name;
      $doctor->email = $request->email;
      $doctor->department = $request->department;
      $doctor->password = Hash::make($request->password);

       $doctor->save();

       return $doctor;

    }

    public function destroy ( $doctor)
    {
       
        return $doctor->delete();
    }
}
