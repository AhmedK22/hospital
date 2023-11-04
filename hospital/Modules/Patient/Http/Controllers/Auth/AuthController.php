<?php

namespace Modules\Patient\Http\Controllers\Auth;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Patient\Entities\Patient;
use Modules\Patient\Http\Requests\LoginRequest;
use Modules\Patient\Http\Requests\RegisterRequest;
use Modules\Patient\Transformers\PatientResource;

class AuthController extends Controller
{

    public function getRegisterForm()
    {
        return view('patient::auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        try {

            $patient = Patient::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $token = $patient->createToken('auth_token')->plainTextToken;

            $cookie = cookie('token', $token, 60 * 24); // 1 day

            return response()->json([
                'patient' => new PatientResource($patient),
            $token = $patient->createToken('auth_token')->plainTextToken,
                'token' => $token
            ])->withCookie($cookie);
        } catch (Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $patient = Patient::where('email', $data['email'])->first();

        if (!$patient || !Hash::check($data['password'], $patient->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!'
            ], 401);
        }

        $token = $patient->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24); // 1 day

        return response()->json([
            'patient' => new PatientResource($patient),
            'token' => $token
        ])->withCookie($cookie);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $cookie = cookie()->forget('token');

        return response()->json([
            'message' => 'Logged out successfully!'
        ])->withCookie($cookie);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
