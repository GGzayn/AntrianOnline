<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\Opd;
use App\Models\Loket;
use App\Models\Antrian;

class LoketController extends Controller
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
        return view ('loket.index',compact('data','data2'));
    }

    public function liveAntrian()
    {
        $data = Loket::where('status_loket',1)->layananDinas()
            ->whereHas('antrian', function ($query) {})
            ->get();

        return view ('live',compact('data'));
    }

    public function statusLoket(Request $request)
    {
        $loket = Loket::find($request->idLoket);
        $loket->status_loket = 1;
        $loket->save();


        return redirect()->route('loket.lokets.index');
    }

    public function hapusLoket(Request $request)
    {
        $loket = Loket::find($request->idLoket);
        $loket->status_loket = 0;
        $loket->save();

        return redirect()->route('loket.lokets.index');
    }

    public function statusAntrian(Request $request)
    {
        $loket = Antrian::find($request->idAntrian);
        $loket->status_antrian = 2;
        $loket->save();

        return redirect()->route('loket.lokets.index');
    }

    public function hapusAntrian(Request $request)
    {
        $loket = Antrian::find($request->idAntrian);
        $loket->status_antrian = 3;
        $loket->save();

        return redirect()->route('loket.lokets.index');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layanan = Layanan::dinas()->get();
        return view('loket.create',compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loket = new Loket;

        $loket->nama_loket = $request->nama_loket;
        $loket->layanan_id = $request->nama_layanan;
        $loket->nama_petugas = $request->nama_petugas;
        $loket->interval_waktu = $request->interval_waktu;
        $loket->interval_booking = 30;
        $loket->waktu_buka = $request->waktu_buka;
        $loket->waktu_tutup = $request->waktu_tutup;

        $loket->save();
        return redirect()->route('dinas.lokets.index')->with('status','new Loket has Been Created');
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

    public function scanQr ()
    {
        return view ('scanQrCode');
    }

    public function mobilePrint(Request $request)
    {
        $res = $request->get('qrCode');
        $antri = Antrian::where('nik',$res)->update(['status_antrian' => 2]);
        $antrix = Antrian::where('nik',$res)->get();
        return view ('printNomor')->with('antrians', $antrix);
    }

    
        
}
