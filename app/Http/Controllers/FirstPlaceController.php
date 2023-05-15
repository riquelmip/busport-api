<?php

namespace App\Http\Controllers;

use App\Models\FirstPlace;
use App\Models\TicketType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FirstPlaceController extends Controller
{
    public function __construct()
    {
        //para que siempre que se quiera acceder a este controlador, verifique la autorizacion, execptuando los metodos del login y registro
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    
    public function index()
    {
        try {
            $places = FirstPlace::all();

            return response()->json([
                'message' => 'Places',
                'data' => $places
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error',
                'data' => $e->getMessage(),
            ], 404);
        }
    }

    public function createOrUpdate(Request $request)
    {
        if ($_POST) {
            $idFirstPlace = $request->input('idFirstPlace');
            $name = $request->input('name');
            $idFirstPlaceType = $request->input('idFirstPlaceType');

            if ($idFirstPlace == 0) {
                //ES CREATE

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'idFirstPlaceType' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                try {

                    $place = FirstPlace::create(['name' => $name, 'id_first_place_type' => $idFirstPlaceType]);

                    return response()->json([
                        'message' => 'Ticket created',
                        'data' => $place
                    ], 201);
                } catch (Exception $e) {
                    return response()->json([
                        'message' => 'Error',
                        'data' => $e->getMessage(),
                    ], 404);
                }
            } else {
                //ES UPDATE

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'idFirstPlaceType' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                try {
                    // TicketType::find($idTicketType)->update(['name' => $name]);
                    $place = FirstPlace::find($idFirstPlace);
                    $place->name = $name;
                    $place->id_first_place_type = $idFirstPlaceType;
                    $place->save();

                    return response()->json([
                        'message' => 'Ticket updated',
                        'data' => $place
                    ], 201);
                } catch (Exception $e) {
                    return response()->json([
                        'message' => 'Error',
                        'data' => $e->getMessage(),
                    ], 404);
                }
            }
        }
    }

    public function show($id)
    {
        try {
            $idFirstPlace = intval($id);

            $place = TicketType::find($idFirstPlace);
            return response()->json([
                'message' => 'Show Ticket',
                'data' => $place
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error',
                'data' => $e->getMessage(),
            ], 404);
        }
    }

    public function delete($idPlace)
    {
        try{
        $idFirstPlace = intval($idPlace);

        $place = TicketType::find($idFirstPlace);
        $place->delete();

        return response()->json([
            'message' => 'Ticket deleted',
            'data' => $place
        ], 201);

    } catch (Exception $e) {
        return response()->json([
            'message' => 'Error',
            'data' => $e->getMessage(),
        ], 404);
    }
    }
}
