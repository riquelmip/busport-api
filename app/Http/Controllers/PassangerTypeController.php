<?php

namespace App\Http\Controllers;

use App\Models\PassangerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassangerTypeController extends Controller
{
    public function index(){
        return PassangerType::all();


    }
    public function CreateOrUpdate(Request $request)
    {
        if($_POST){
            $idPassangerType=$request->input('idPassangerType');
            $name=$request->input('name');
            if($idPassangerType==0){

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $passanger=PassangerType::create(['name'=>$name]);

                return response()->json([
                    'message' => 'Passanger has been updated',
                    'data' => $passanger
                ], 201);
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                
                $passanger = PassangerType::find($idPassangerType);
                $passanger->name = $name;
                $passanger->save();

                return response()->json([
                    'message' => 'Passanger has been updated',
                    'data' => $passanger
                ], 201);

            }

        }
    }
    public function delete($idPassangerType){ 
        $idTicketType = intval($idPassangerType);

        $passager = PassangerType::find($idPassangerType);
        $passager->delete();

        return response()->json([
            'message' => 'Passanger deleted',
            'data' => $passager
        ], 201);
    }
    public function show($idPassangerType){ 
        $idTicketType = intval($idPassangerType);

        $passager = PassangerType::find($idPassangerType);
      

        return response()->json([
            'message' => 'shown passenger',
            'data' => $passager
        ], 201);
    }
}


 