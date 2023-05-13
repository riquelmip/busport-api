<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    
    
    public function index()
    {
        $trips = Trip::all();

        return response()->json([
            'message' => 'Trips',
            'data' => $trips
        ], 201);
    }

    
}
