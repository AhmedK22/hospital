<?php

namespace Modules\Appointment\Http\Repositories;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Appointment\Entities\Appointment;

class AppointmentRepository
{

    public function search(Request $request)
    {
        $appointment = Appointment::query();

        if($request->filled('doctor_id')) {
            $appointment->where('doctor_id', $request->doctor_id );
        }

        if($request->filled('id')) {
            $appointment->where('id', $request->id);
        }

        if($request->filled('patient_id')) {
            $appointment->where('id', $request->patient_id);
        }

        return $appointment;
    }

    public function fill(Request $request,Appointment $appointment=null)
    {
      if(!isset($appointment)) {
        $appointment = new Appointment();
      }
      if($request->has('status')) {
         $appointment->status = $request->status;
      }

      if($request->has('patient_id')) {

          $appointment->patient_id = $request->patient_id;
     }

     if($request->has('email')) {

        $appointment->email = $request->email;
     }

     if($request->has('appointment')) {

        $appointment->appointment = $request->appointment;

     }
     if($request->has('doctor_id')) {

         $appointment->doctor_id = $request->doctor_id;
        }
       
       $appointment->save();

       return $appointment;

    }

    public function destroy (Appointment $appointment)
    {
        return $appointment->delete();
    }
}
