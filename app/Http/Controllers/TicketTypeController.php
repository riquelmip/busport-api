<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketTypeController extends Controller
{
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

                $ticket = TicketType::create(['name' => $name, 'idcountry' => null]);

                return response()->json([
                    'message' => 'Ticket creado',
                    'data' => $ticket
                ], 201);
                
            } else {
                //ES UPDATE

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                // TicketType::find($idTicketType)->update(['name' => $name]);
                $ticket = TicketType::find($idTicketType);
                $ticket->name = $name;
                $ticket->save();

                return response()->json([
                    'message' => 'Ticket actualizado',
                    'data' => $ticket
                ], 201);

            }
        }
    }

    public function delete($idTicket){ 
        $idTicketType = intval($idTicket);

        $ticket = TicketType::find($idTicketType);
        $ticket->delete();

        return response()->json([
            'message' => 'Ticket eliminado',
            'data' => $ticket
        ], 201);
    }
}
