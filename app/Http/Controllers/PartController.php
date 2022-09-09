<?php

namespace App\Http\Controllers;
use App\Models\Part;
use App\Models\TypePart;

use Illuminate\Http\Request;
use App\DataTables\PartDataTable;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartDataTable $dataTable)
    {
        $TypePart = TypePart::all();

        return $dataTable->render('dashboard.part.index',['typepart' => $TypePart]);
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
            'id_typepart' => 'required',
            'part_nama' => 'required',
        ]);

        $part = Part::create([
            'id_typepart' => $request->id_typepart,
            'part_nama' => $request->part_nama
        ]);

        return redirect()->back()->with('message','Data Successfully Added.');
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
            'id_typepart' => 'required',
            'part_nama' => 'required',
        ]);

        $part = Part::find($id)->update([
            'id_typepart' => $request->id_typepart,
            'part_nama' => $request->part_nama
        ]);

        return redirect()->back()->with('message','Part Successfully Saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Part::destroy($id);

        return redirect()->back()->with('message','Part Deleted.');
    }
}
