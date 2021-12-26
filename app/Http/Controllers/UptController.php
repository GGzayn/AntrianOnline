<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upt;

class UptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upt = Upt::paginate(10);
        return view ('upt.index',compact('upt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view ('upt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Upt;

        $data->upt = $request->upt;
        $data->kode_upt = $request->kode_upt;
        $data->alamat = $request->alamat;

        $data->save();

        return redirect()->route('admin.upts.index')->with('status','New UPT has been created.');
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
        $upt = Upt::where('id',$id)->get();
        return view('upt.edit',compact('upt'));
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
        $data = Upt::find($id);
        $data->upt = $request->upt;
        $data->kode_upt = $request->kode_upt;
        $data->alamat = $request->alamat;

        $data->save();

        return redirect()->route('admin.upts.index')->with('status','UPT has been Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upt = Upt::find($id);
        $upt->delete();
        return redirect()->route('admin.upts.index')->with('status','UPT has been Deleted.');

    }

    public function show_upt()
    {
        $upt = Upt::get();
        return Response([
            'status' => true,
            'message' => 'Pengambilan Data Berhasil',
            'data' => $upt,
        ], 200);
    }
}
