<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Opd;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Opd::paginate(5);
        return view ('opd.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $data = new Opd;
        $data->id_opd = $request->id_opd;
        $data->nama_opd = $request->nama_opd;
        $data->nama_kordinator = $request->nama_kordinator;
        $data->nip_kordinator = $request->nip_kordinator;
        $data->jabatan = $request->jabatan;

        $data->save();

        return redirect()->route('admin.opds.index')->with('status','new OPD has Been Created');
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
        $opd = Opd::where('id',$id)->get();
        return view('opd.edit',compact('opd'));
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
        $data = Opd::find($id);
        $data->id_opd = $request->id_opd;
        $data->nama_opd = $request->nama_opd;
        $data->nama_kordinator = $request->nama_kordinator;
        $data->nip_kordinator = $request->nip_kordinator;
        $data->jabatan = $request->jabatan;

        $data->save();

        return redirect()->route('admin.opds.index')->with('status',' OPD has Been Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Opd::find($id);
        $data->delete();
        return redirect()->route('admin.opds.index')->with('status',' OPD has Been Deleted');
    }

    public function MobileOpdList()
    {
        $opd = Opd::get();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $opd
        ], 200);
    }
}
