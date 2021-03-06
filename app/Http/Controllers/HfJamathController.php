<?php

namespace App\Http\Controllers;

use App\Models\HfJamath;
use Illuminate\Http\Request;

class HfJamathController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', /*['except' => ['login']]*/);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hfJamaths = HfJamath::all();
        $data = $hfJamaths->map(function ($hfJamath) {
            return [
                $hfJamath,
                $hfJamath->address
            ];
        });
        return response()->json($hfJamaths);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        

        $hfJamath = HfJamath::create($data);

        return response()->json([
            'msg' => "Successfully created a new HfJamath entry",
            'jamath' => $hfJamath
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfJamath  $hfJamath
     * @return \Illuminate\Http\Response
     */
    public function show(HfJamath $hfJamath)
    {
        $data = $hfJamath->getJamathDetail($hfJamath);

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfJamath  $hfJamath
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfJamath $hfJamath)
    {
        $data= $request->json()->all();
        $data['created_by_id'] = auth()->user()->id;
        $hfJamath->update($data);

        return response()->json(['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfJamath  $hfJamath
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfJamath $hfJamath)
    {
        //
    }

    public function jamaths($id)
    {
        $allJamaths = HfJamath::where('taluk_id', $id)->get();
        if ($allJamaths) {
            return response()->json($allJamaths);
        }
        return response()->json(['msg' => "There is no entry of Jamaths for this Taluk"], 500);
    }
}
