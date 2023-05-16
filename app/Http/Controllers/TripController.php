<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function __construct()
    {
        //para que siempre que se quiera acceder a este controlador, verifique la autorizacion, execptuando los metodos del login y registro
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $trips = Trip::all();

            return response()->json([
                'message' => 'Trips',
                'data' => $trips
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
            $idTrip = $request->input('idTrip');

            //verify de foreig keys


            $validator = Validator::make($request->all(), [
                'id_origin_city' => 'required',
                'id_destination_city' => 'required',
                'travel_time' => 'required',
                'departure_time' => 'required',
                'arrival_time' => 'required',
                'price' => 'required',
                'id_class_service' => 'required',
                'id_ticket' => 'required',
                'id_passenger_type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if ($idTrip == 0) {
                //ES CREATE


                $trip = Trip::create(
                    [
                        'id_origin_city' => $request->input('id_origin_city'),
                        'id_destination_city' => $request->input('id_destination_city'),
                        'travel_time' => $request->input('travel_time'),
                        'departure_time' => $request->input('departure_time'),
                        'arrival_time' => $request->input('arrival_time'),
                        'price' => $request->input('price'),
                        'id_class_service' => $request->input('id_class_service'),
                        'id_ticket' => $request->input('id_ticket'),
                        'id_passenger_type' => $request->input('id_passenger_type'),
                    ]
                );

                return response()->json([
                    'message' => 'Trip created',
                    'data' => $trip
                ], 201);
            } else {
                //ES UPDATE
                $trip = Trip::find($idTrip);
                $trip->id_origin_city = $request->input('id_origin_city');
                $trip->id_destination_city = $request->input('id_destination_city');
                $trip->travel_time = $request->input('travel_time');
                $trip->departure_time = $request->input('departure_time');
                $trip->arrival_time = $request->input('arrival_time');
                $trip->price = $request->input('price');
                $trip->id_class_service = $request->input('id_class_service');
                $trip->id_ticket = $request->input('id_ticket');
                $trip->id_passenger_type = $request->input('id_passenger_type');
                $trip->save();

                return response()->json([
                    'message' => 'Trip updated',
                    'data' => $trip
                ], 201);
            }
        }
    }

    public function show($id)
    {
        $idTrip = intval($id);

        $trip = Trip::find($idTrip);
        return response()->json([
            'message' => 'Show Trip',
            'data' => $trip
        ], 201);
    }

    public function delete($id)
    {
        $idTrip = intval($id);

        $trip = Trip::find($idTrip);
        $trip->delete();

        return response()->json([
            'message' => 'Trip deleted',
            'data' => $trip
        ], 201);
    }
}
