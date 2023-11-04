<?php

namespace Modules\Doctor\Http\Controllers\Autn;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Http\Requests\LoginDoctor;
use Modules\Doctor\Transformers\DoctorResource;

class AuthController extends Controller
{

    public function getLoginForm()
    {
        return view('doctor::auth.login');
    }

    public function login(LoginDoctor $request)
    {
        $data = $request->validated();

        $doctor = Doctor::where('email', $data['email'])->first();

        if (!$doctor || !Hash::check($data['password'], $doctor->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!'
            ], 401);
        }

        $token = $doctor->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24); // 1 day

        return response()->json([
            'doctor' => new DoctorResource($doctor),
            'token' => $token,
        ])->withCookie($cookie);
    }

}
