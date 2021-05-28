<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\Antrian;
use App\Models\Loket;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $dataTotalAntrianLoket = Loket::with('antrian')->LayananDinas()
            ->whereHas('antrian', function ($query) {
                $query->where('tanggal_antrian', date('Y-m-d'))->where('status_antrian',1);
            })->paginate(10);

       
        $dataAntrian = Antrian::with('loket')->where('status_antrian',1)->paginate(10);


        return view ('antrian.index',compact('dataTotalAntrianLoket','dataAntrian'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function MobileRegister(Request $request)
    {
        $validated = $request->validate([
            'tanggal_booking' => 'required',
            'loket_id' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'tanggal_antrian' => 'required',
            'waktu_antrian' => 'required',
        ]);
        
        $antCount = Antrian::where('loket_id', $request->loket_id)->count();
        $antrian = new Antrian;

        $antrian->tanggal_booking = now();
        $antrian->loket_id = $request->loket_id;
        $antrian->nama = $request->nama;
        $antrian->nik = $request->nik;
        $antrian->tanggal_antrian = $request->tanggal_antrian;
        $antrian->waktu_antrian = $request->waktu_antrian;
        $antrian->jenis_antrian = 0;
        $antrian->status_antrian = 0;
        $antrian->no_antrian = $antCount+ 1;

        $antrian->save();

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $antrian
        ], 200);

    }

    public function historyAntrian($nik)
    {
        $antrian = Antrian:: where('nik', $nik)->get();

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $antrian
        ], 200);
    }
}
