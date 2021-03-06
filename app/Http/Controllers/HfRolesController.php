<?php

namespace App\Http\Controllers;

use App\Models\HfRole;
use Illuminate\Http\Request;

class HfRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role->id == '1'){
            $hfRoles = HfRole::all();
            return response()->json($hfRoles);
        }else{
            $hfRoles = HfRole::where('parent_id',$user->role->id)->get();
            if($hfRoles){
                return response()->json($hfRoles);
            }
            return response()->json(['msg'=>"No Role Assign Access"]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfRole  $hfRole
     * @return \Illuminate\Http\Response
     */
    public function show(HfRole $hfRole)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfRole  $hfRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfRole $hfRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfRole  $hfRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfRole $hfRole)
    {
        //
    }
}
