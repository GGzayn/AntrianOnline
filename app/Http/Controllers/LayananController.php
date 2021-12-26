<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Layanan;
use App\Models\Opd;
use App\Models\Loket;
use App\Models\Districts;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth()->user()->role->id;
        if ($role != 1) {
            $data = Layanan::with('opd')->dinas()->paginate(10);
        }else{
            $data = Layanan::with('opd')->paginate(10);
        }
        return view ('layanan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Layanan;
        $data->opd_id = auth()->user()->child_id;
        $data->nama_layanan = $request->nama_layanan;
        $data->kode_layanan = $request->kode_layanan;
        $data->alamat = $request->alamat;
        $data->no_telepon = $request->no_telepon;
        $data->jenis_layanan = $request->jenis_layanan;
        $data->kata_kunci = $request->kata_kunci;

        $data->save();

        return redirect()->route('dinas.layanans.index')->with('status','new Layanan has Been Created');
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
        $layanan = Layanan::where('id', $id)->with('opd')->get();
        return view('layanan.edit',compact('layanan'));
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
        $layanan = Layanan::find($id);
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->kode_layanan = $request->kode_layanan;
        $layanan->alamat = $request->alamat;
        $layanan->no_telepon = $request->no_telepon;
        $layanan->jenis_layanan = $request->jenis_layanan;
        $layanan->kata_kunci = $request->kata_kunci;

        $layanan->save();
        return redirect()->route('dinas.layanans.index')->with('status','new Layanan has Been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layanan = Layanan::find($id);

        $layanan->delete();
        return redirect()->route('dinas.layanans.index')->with('status','new Layanan has Been Deleted');
    }

    public function MobileLayananList()
    {
        $layanan = Layanan::with('opd')->has('loketAnt')->get();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'layanan' => $layanan,
        ], 200);
    }

    public function showUpt()
    {
        $kecamatan = Districts::where('city_id',3603)->with('upt')->get();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $kecamatan,
        ], 200);
    }
}
