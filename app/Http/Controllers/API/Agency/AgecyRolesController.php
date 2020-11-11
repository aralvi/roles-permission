<?php

namespace App\Http\Controllers\API\Agency;

use App\Http\Controllers\Controller;
use App\Models\AgencyRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgecyRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $agencyRoles = AgencyRole::where('agency_id',$id)->get();
        return response()->json(['Agency Roles' => $agencyRoles]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['message' => 'you can create your role']);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:agency_roles|between:2,100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $agencyRole = new AgencyRole();
        $agencyRole->name = $request->name;
        $agencyRole->agency_id  = $request->agency_id;
        if($agencyRole->save()){
            return response()->json(['agency role' => $agencyRole]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agencyRole = AgencyRole::findOrFail($id);
        return response()->json(['agency role' => $agencyRole]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:agency_roles|between:2,100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $agencyRole = AgencyRole::findOrFail($id);
        $agencyRole->name = $request->name;
        if ($agencyRole->save()) {
            return response()->json(['agency role' => $agencyRole]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AgencyRole::findOrFail($id)->delete();
        return response()->json(['message' => "your role is successfuly deleted!"]);
    }
}
