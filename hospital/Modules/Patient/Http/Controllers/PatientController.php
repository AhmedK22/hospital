<?php

namespace Modules\Patient\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Appointment\Entities\Appointment;
use Modules\Appointment\Http\Repositories\AppointmentRepository;
use Modules\Appointment\Http\Requests\CreateAppointment;
use Modules\Appointment\Transformers\AppointmentResource;
use Modules\Patient\Http\Repositories\PatientRepository;
use Modules\Patient\Http\Requests\RegisterRequest;
use Modules\Patient\Transformers\PatientResource;

class PatientController extends Controller
{
    public function __construct(public PatientRepository $patientRepository, public AppointmentRepository $appointmentRepository)
    {
    }

    public function getAppointments(Request $request)
    {

        $request->merge(['patient_id'=>Auth::user()->id]);
        $appointmens = $this->appointmentRepository->search($request)->get();
        return response()->json([
            'appointmens' => AppointmentResource::collection($appointmens)
        ]);
    }




    public function createAppointment(CreateAppointment $request)
    {

        try {

            if (!$data = $this->appointmentRepository->fill($request)) {
                return response()->json([
                    'appointment'=>new AppointmentResource($data),
                    'message' => 'appointment created successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function index(Request $request)
    {
        $patient = $this->patientRepository->search($request)->get();

        return response()->json([
            'patient' => PatientResource::collection($patient)
        ]);
    }


    public function create(RegisterRequest $request)
    {
        try {

           $data = $this->patientRepository->fill($request);
                return response()->json([
                    'patient'=>new PatientResource($data),
                    'message' => 'patient created successfully'
                ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function update(RegisterRequest $request, $patient)
    {
        try {
            $request->merge(['id'=>$patient]);
            $patientObj = $this->patientRepository->search($request)->first();
            if(!isset($patientObj)) {

                return response()->json(['error' =>  'this id doesnot exist']);
            }

            $data = $this->patientRepository->fill($request, $patientObj);
            return response()->json([
                'patient'=>new PatientResource($data),

                'message' => 'patient updated successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function destroy(Request $request,$patient)
    {
        try {
            $request->merge(['id'=>$patient]);
             $patientObj = $this->patientRepository->search($request)->first();
            if(!isset(  $patientObj)) {

                return response()->json(['error' =>  'this id doesnot exist']);
            }

           $this->patientRepository->destroy($patientObj);

            return response()->json(['data' =>  'element deleted']);
        } catch(Exception $e) {

            return response()->json(['error' =>  'there is error from our side']);
        }
    }
}
