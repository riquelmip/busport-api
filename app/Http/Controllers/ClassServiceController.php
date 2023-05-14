<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\class_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassServiceController extends Controller
{

    public function index()
    {
        return class_service::all();
    }
    
    public function createOrUpdate(Request $request)
    {
        if ($_POST) {
            $idClassService = $request->input('idClassService');
            $name = $request->input('name');

            if ($idClassService == 0) {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:class_service',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $ClassService = class_service::create(['name' => $name, 'idClassService' => null]);

                return response()->json([
                    'message' => 'Service  created',
                    'data' => $ClassService
                ], 201);
            } else {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:class_service',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $ClassService = class_service::find($idClassService);
                $ClassService->name = $name;
                $ClassService->save();

                return response()->json([
                    'message' => 'Update Service',
                    'data' => $ClassService
                ], 201);
            }
        }
    }

    public function show($idClassService)
    {
        $ClassService = class_service::findOrFail($idClassService);

        return response()->json([
            'res' => true,
            'data' => $ClassService,
            'msg' => 'See Service'
        ], 200);
    }

    public function delete($idClassService)
    {
        $ClassService = class_service::findOrFail($idClassService);

        $ClassService->delete();

        return response()->json([
            'res' => true, //Retorna una respuesta
            'data' => $ClassService, //retorna toda la data
            'message' => 'Service removed'
        ], 200);
       
    }
}
