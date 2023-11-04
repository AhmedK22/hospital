<?php

namespace Modules\Appointment\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Appointment\Http\Repositories\AppointmentRepository;
use Modules\Appointment\Http\Requests\AppointmentRequest;
use Modules\Appointment\Http\Requests\CreateAppointment;
use Modules\Appointment\Http\Services\AppointmentService;
use Modules\Appointment\Transformers\AppointmentResource;

class AppointmentController extends Controller
{

    public function __construct(public AppointmentRepository $appointmentRepository, public AppointmentService $appointmentServise)
    {
    }

    public function index(AppointmentRequest $request)
    {

        $appointment = $this->appointmentRepository->search($request)->get();

        return response()->json([
            'appointment' => AppointmentResource::collection($appointment)
        ]);
    }


    public function create(CreateAppointment $request)
    {  

        return $this->appointmentServise->createAppointment($request);
    }


    public function update(CreateAppointment $request, $appointment)
    {
        try {
            $request->merge(['id' => $appointment]);
            $appointmentObj = $this->appointmentRepository->search($request)->first();
            if (!isset($appointmentObj)) {

                return response()->json(['error' =>  'this id doesnot exist']);
            }

            $data = $this->appointmentRepository->fill($request, $appointmentObj);
            return response()->json([
                'appointment' => new AppointmentResource($data),

                'message' => 'appointment updated successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function destroy(Request $request, $appointment)
    {
        try {
            $request->merge(['id' => $appointment]);
            $appointmentObj = $this->appointmentRepository->search($request)->first();
            if (!isset($appointmentObj)) {

                return response()->json(['error' =>  'this id doesnot exist']);
            }

            $this->appointmentRepository->destroy($$appointmentObj);

            return response()->json(['data' =>  'element deleted']);
        } catch (Exception $e) {

            return response()->json(['error' =>  'there is error from our side']);
        }
    }
}
