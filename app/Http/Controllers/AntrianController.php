<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Opd;

class AntrianController extends Controller
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
            $data = Loket::with(['layanan.opd', 'antrian'])->layananDinas()->paginate(10);
            $data2 = Loket::where('status_loket',1)->layananDinas()
            ->whereHas('antrian', function ($query) {
            })
            ->get();



        }else{
            $data = Loket::with('layanan.opd')->paginate(10);
        }
        // dd($data2);
        return view ('antrian.index',compact('data','data2'));
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

        $loket = Loket::where('layanan_id', $request->layanan_id)->where('loket_antrian', 1)->pluck('id');

        foreach($loket as $l)
        {
            $idLok = $l;
        }

        $kodelay = Layanan::where('id',$request->layanan_id)->pluck('kode_layanan');
        $antCount = Antrian::where('loket_id', $idLok)->get();

        $nomAntri = count($antCount) +1;
        foreach($kodelay as $r)
        {
            $has = $r;
        }
        
        $finalNoAntri = "$has - $nomAntri";
        
        // print_r($finalNoAntri);exit;

        
        $antrian = new Antrian;

        $antrian->tanggal_booking = now();
        $antrian->loket_id = $idLok;
        $antrian->nama = $request->nama;
        $antrian->nik = $request->nik;
        $antrian->tanggal_antrian = $request->tanggal_antrian;
        $antrian->waktu_antrian = $request->waktu_antrian;
        $antrian->jenis_antrian = 0;
        $antrian->status_antrian = 0;
        $antrian->no_antrian = $finalNoAntri;


        $antrian->save();

        return Response([
            'status' => 'success',
            'message' => 'Input data berhasil',
            'data' => $antrian
        ], 200);

    }

    public function historyAntrian($nik)
    {
        $antrian = Antrian::where('nik', $nik)->with('loket.layanan.opd')->get();
       

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'antrian' => $antrian,
           
        ], 200);
    }

    public function homeAntrian($nik)
    {
        $antrian = Antrian::where('nik', $nik)->with('loket.layanan.opd')->limit()5->get();

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'antrian' => $antrian
        ], 200);
    }
}
