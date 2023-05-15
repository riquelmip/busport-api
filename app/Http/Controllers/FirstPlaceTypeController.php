<?php

namespace App\Http\Controllers;

use App\Models\FirstPlaceTypeModel;
use Illuminate\Http\Request;

class FirstPlaceTypeController extends Controller
{
    public function index(Request $request)
    {
        $firstPlaceTypes = FirstPlaceTypeModel::all();
        return response()->json($firstPlaceTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firstPlaceType = new FirstPlaceTypeModel;
        $firstPlaceType->name = $request->name;
        $firstPlaceType->save();
        return response()->json(['message' => 'Successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $firstPlaceType = FirstPlaceTypeModel::find($id);
        return response()->json($firstPlaceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $firstPlaceType = FirstPlaceTypeModel::find($id);
        $firstPlaceType->name = $request->name;
        $firstPlaceType->save();
        return response()->json(['message' => 'Successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firstPlaceType = FirstPlaceTypeModel::find($id);
        $firstPlaceType->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
