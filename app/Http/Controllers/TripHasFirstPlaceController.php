<?php

namespace App\Http\Controllers;

use App\Models\FirstPlace;
use App\Models\TicketType;
use App\Models\TripHasFirstPlace;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripHasFirstPlaceController extends Controller
{
    public function __construct()
    {
        //para que siempre que se quiera acceder a este controlador, verifique la autorizacion, execptuando los metodos del login y registro
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    
    public function index()
    {
        try {
            $places = TripHasFirstPlace::select(
                'trip.id as id_trip',
                'trip.id as id_origin_city',
                'trip.id as id_destination_city',
                'first_place.id as id_first_place',
                'first_place.name as first_place',
            )
            ->join('trip', 'trip.id', 'trip_has_first_places.id_trip')
            ->join('first_place', 'first_place.id', 'trip_has_first_places.id_first_place')
            ->get();

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
            $idTripHasFirstPlace = $request->input('idTripHasFirstPlace');
            $idFirstPlace = $request->input('idFirstPlace');
            $idTrip = $request->input('idTrip');

            if ($idTripHasFirstPlace == 0) {
                //ES CREATE

                $validator = Validator::make($request->all(), [
                    'idTrip' => 'required',
                    'idFirstPlace' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                try {

                    $place = TripHasFirstPlace::create(['id_trip' => $idTrip, 'id_first_place' => $idFirstPlace]);

                    return response()->json([
                        'message' => 'Relation created',
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
                    'idTrip' => 'required',
                    'idFirstPlace' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                try {
                    // TicketType::find($idTicketType)->update(['name' => $name]);
                    $place = TripHasFirstPlace::find($idTripHasFirstPlace);
                    $place->id_trip = $idTrip;
                    $place->id_first_place = $idFirstPlace;
                    $place->save();

                    return response()->json([
                        'message' => 'Relation updated',
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

            $place = TripHasFirstPlace::find($idFirstPlace);
            return response()->json([
                'message' => 'Show Relation',
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

        $place = TripHasFirstPlace::find($idFirstPlace);
        $place->delete();

        return response()->json([
            'message' => 'Relation deleted',
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
