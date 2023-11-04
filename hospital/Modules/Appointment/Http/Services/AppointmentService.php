<?php

namespace Modules\Appointment\Http\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Modules\Appointment\Events\AppointmentNotify;
use Modules\Appointment\Http\Repositories\AppointmentRepository;

use Modules\Appointment\Transformers\AppointmentResource;

class AppointmentService
{
    public function __construct(public AppointmentRepository $appointmentRepository)
    {
    }
    public function createAppointment(Request $request)
    {
        try {

            $data = $this->appointmentRepository->fill($request);
            if (!Auth::check() and !Auth::guard('admin')->check()) {
                event(new AppointmentNotify($data));
            }

            return response()->json([
                'appointment' => new AppointmentResource($data),
                'message' => 'appointment created successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}

