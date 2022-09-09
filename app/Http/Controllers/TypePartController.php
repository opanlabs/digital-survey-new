<?php

namespace App\Http\Controllers;


use App\Models\TypePart;

use Illuminate\Http\Request;
use App\DataTables\TypePartDataTable;

class TypePartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TypePartDataTable $dataTable)
    {
        return $dataTable->render('dashboard.typepart.index');
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
            'type_nama' => 'required',
        ]);

        $typepart = TypePart::create([
            'type_nama' => $request->type_nama
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
            'type_nama' => 'required',

        ]);

        $typepart = TypePart::find($id)->update([
            'type_nama' => $request->type_nama,
        ]);

        return redirect()->back()->with('message','TypePart Successfully Saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TypePart::destroy($id);

        return redirect()->back()->with('message','TypePart Deleted.');
    }
}
