<?php

namespace App\Http\Controllers\API\Agency;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyRole;
use App\Models\AgencyUserAgency;
use App\Models\AgencyUserAgencyRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AgeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::with('AgencyRoles')->get();
        return response()->json(['agencies'=>$agencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['message'=>'now you can create your agency']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:agencies|between:2,100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $agency = new Agency();
        $agency->name = $request->name;
        if($agency->save()){
            $agencyUser  = new AgencyUserAgency();
            $agencyUser->agency_user_id = Auth::id();
            $agencyUser->agency_id = $agency->id;
            if($agencyUser->save()){
                $role = new AgencyRole();
                $role->agency_id = $agency->id;
                $role->name = 'admin';
                if($role->save()){
                    $agency_user_role = new AgencyUserAgencyRole();
                    $agency_user_role->agency_user_agency_id = $agencyUser->id;
                    $agency_user_role->agency_role_id = $role->id;
                    $agency_user_role->save();
                    return response()->json(['message'=>"your agency has been registered"]);
                }
            }
        }else{
            return response()->json(['message'=>"Opps something went wrong"]);

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
        $agency = Agency::where('id',$id)->with('AgencyRoles')->get();
        return response()->json(['agency'=> $agency]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency  = Agency::findOrFail($id);
        return response()->json(['agency' => $agency]);

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
            'name' => 'required|string|unique:agencies|between:2,100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $agency  = Agency::findOrFail($id);
        $agency->name = $request->name;
        $agency->save();
        return response()->json(['agency' => $agency]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agency = Agency::findOrFail($id)->delete();
        return response()->json(['message'=>'your company has been deleted !']);
    }
}
