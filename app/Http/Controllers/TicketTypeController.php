<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketTypeController extends Controller
{
    public function index()
    {
        try {
            $tickets = TicketType::all();

            return response()->json([
                'message' => 'Tickets',
                'data' => $tickets
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
            $idTicketType = $request->input('idTicketType');
            $name = $request->input('name');

            if ($idTicketType == 0) {
                //ES CREATE

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                try {

                    $ticket = TicketType::create(['name' => $name]);

                    return response()->json([
                        'message' => 'Ticket created',
                        'data' => $ticket
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
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                try {
                    // TicketType::find($idTicketType)->update(['name' => $name]);
                    $ticket = TicketType::find($idTicketType);
                    $ticket->name = $name;
                    $ticket->save();

                    return response()->json([
                        'message' => 'Ticket updated',
                        'data' => $ticket
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
            $idTicketType = intval($id);

            $ticket = TicketType::find($idTicketType);
            return response()->json([
                'message' => 'Show Ticket',
                'data' => $ticket
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error',
                'data' => $e->getMessage(),
            ], 404);
        }
    }

    public function delete($idTicket)
    {
        try{
        $idTicketType = intval($idTicket);

        $ticket = TicketType::find($idTicketType);
        $ticket->delete();

        return response()->json([
            'message' => 'Ticket deleted',
            'data' => $ticket
        ], 201);

    } catch (Exception $e) {
        return response()->json([
            'message' => 'Error',
            'data' => $e->getMessage(),
        ], 404);
    }
    }
}
