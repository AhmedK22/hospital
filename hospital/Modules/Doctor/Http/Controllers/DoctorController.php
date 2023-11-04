<?php

namespace Modules\Doctor\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


use Modules\Doctor\Http\Repositories\DoctorRepository;
use Modules\Doctor\Http\Requests\CreateDoctor;
use Modules\Doctor\Transformers\DoctorResource;

class DoctorController extends Controller
{

    public function __construct(public DoctorRepository $doctorRepository)
    {
    }

    public function index(Request $request)
    {
        $doctor = $this->doctorRepository->search($request)->get();

        return response()->json([
            'doctor' => DoctorResource::collection($doctor)
        ]);
    }


    public function create(CreateDoctor $request)
    {

        try {

            $data = $this->doctorRepository->fill($request);
                return response()->json([
                    'doctor'=>new DoctorResource($data),
                    'message' => 'doctor created successfully'
                ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function update(CreateDoctor $request, $doctor)
    {
        try {
            $request->merge(['id'=>$doctor]);
            $doctorObj = $this->doctorRepository->search($request)->first();
            if(!isset($doctorObj)) {

                return response()->json(['error' =>  'this id doesnot exist']);
            }

            $data = $this->doctorRepository->fill($request, $doctorObj);
            return response()->json([
                'doctor'=>new DoctorResource($data),

                'message' => 'doctor updated successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function destroy(Request $request,$doctor)
    {
        try {
            $request->merge(['id'=>$doctor]);
             $doctorObj = $this->doctorRepository->search($request)->first();
    
            if(!isset($doctorObj)) {

                return response()->json(['error' =>  'this id doesnot exist']);
            }
            $this->doctorRepository->destroy($doctorObj);

            return response()->json(['data' =>  'element deleted']);

        } catch(Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' =>  'there is error from our side']);
        }
    }
}
