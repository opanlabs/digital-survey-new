<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\VehicleDataTable;


use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function autocomplete(Request $request)
    {
        $vehicle = [];
        $search = $request->input('q');
        $vehicle = vehicle::select("id_vehicle", "nama")
                ->where('nama', 'like', "%$search%")
                ->get();
        return response()->json($vehicle);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VehicleDataTable $dataTable)
    {
        return $dataTable->render('dashboard.vehicle.index');
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
        $request->validate([
            'nama' => 'required',
        ]);

        $nama = Vehicle::create([
            'nama' => $request->nama
        ]);

        return redirect()->back()->with('message','Manufaktur Successfully Added.');
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
        //
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
        // dd($request);
        $request->validate([
            'nama' => 'required',
        ]);

        $nama = Vehicle::find($id)->update([
            'nama' => $request->nama,
        ]);

        return redirect()->back()->with('message','Manufaktur Successfully Saved.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::destroy($id);

        return redirect()->back()->with('message','Manufaktur Deleted.');
    }
}
