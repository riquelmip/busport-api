<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function __construct()
    {
        //para que siempre que se quiera acceder a este controlador, verifique la autorizacion, execptuando los metodos del login y registro
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    
    public function index()
    {
        return Country::all();
    }

    public function createOrUpdate(Request $request)
    {
        if ($_POST) {
            $idCountry = $request->input('idCountry');
            $name = $request->input('name');

            if ($idCountry == 0) {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:country',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $country = Country::create(['name' => $name, 'idcountry' => null]);

                return response()->json([
                    'message' => 'Country created',
                    'data' => $country
                ], 201);
            } else {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:country',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $country = Country::find($idCountry);
                $country->name = $name;
                $country->save();

                return response()->json([
                    'message' => 'Update country',
                    'data' => $country
                ], 201);
            }
        }
    }

    public function show($idCountry)
    {
        $country = Country::findOrFail($idCountry);

        return response()->json([
            'res' => true,
            'data' => $country,
            'msg' => 'See country'
        ], 200);
    }

    public function delete($idCountry)
    {
        $country = Country::findOrFail($idCountry);

        $country->delete();

        return response()->json([
            'res' => true, //Retorna una respuesta
            'data' => $country, //retorna toda la data
            'message' => 'Country removed'
        ], 200);
        //204 No Content
    }
}
