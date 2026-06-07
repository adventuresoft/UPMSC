<?php

namespace App\Http\Controllers;

use App\Models\Upazilla;
use Illuminate\Http\Request;

class UpazillaController extends Controller
{

    public function upazillasByDistrict(Request $request, $id)
    {
        $html = '<option value="">Select '.($request->id ? ucfirst($request->id) : '').' Upazilla</option>';

        $upazillas = Upazilla::where('district_id', $id)->get();

        if(count($upazillas)) {
            foreach ($upazillas as $upazilla) {
               $html .='<option value="'.$upazilla->id.'">'.$upazilla->name.'</option>';
            }
        }

        return $html;
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function show(Upazilla $upazilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Upazilla $upazilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upazilla $upazilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upazilla  $upazilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upazilla $upazilla)
    {
        //
    }
}
