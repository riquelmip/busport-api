<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function createOrUpdate(Request $request)
    {
        if ($_POST) {
            $idCity = $request->input('idCity');
            $name = $request->input('name');

            if ($idCity == 0) {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:city',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $city = City::create(['name' => $name, 'idcity' => null]);

                return response()->json([
                    'message' => 'City created',
                    'data' => $city
                ], 201);
            } else {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:city',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $city = City::find($idCity);
                $city->name = $name;
                $city->save();

                return response()->json([
                    'message' => 'Update city',
                    'data' => $city
                ], 201);
            }
        }
    }

    public function show($idCity)
    {
        $city = City::findOrFail($idCity);

        return response()->json([
            'res' => true,
            'data' => $city,
            'msg' => 'See city'
        ], 200);
    }

    public function delete($idCity)
    {
        $city = City::findOrFail($idCity);

        $city->delete();

        return response()->json([
            'res' => true, //Retorna una respuesta
            'data' => $city, //retorna toda la data
            'message' => 'City removed'
        ], 200);
        //204 No Content
    }
}
