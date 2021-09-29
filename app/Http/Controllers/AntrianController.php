<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Layanan;
use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Opd;
use App\Models\Districts;
use App\Models\Urbans;
use App\Models\Cities;
use App\Models\Provinces;

use Illuminate\Support\Facades\Validator;

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
        if ($role == 2 || $role == 3) {
            $data = Loket::where('child_id',auth()->user()->child_id)->with(['layanan.opd', 'antrian'])->layananDinas()->paginate(10);
        }
        elseif($role == 4 || $role == 5)
        {
            $data = Loket::where('child_id',auth()->user()->child_id)->with('district','layanan.opd','antrian')->paginate(10);
        }

        elseif($role == 7)
        {
            $data = Loket::where('child_id',auth()->user()->child_id)->with(['layanan.opd', 'antrian'])->paginate(10);
        }
        return view ('antrian.index',compact('data'));
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

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nik' => 'required|',
            'tanggal_antrian' => 'required|',
            'waktu_antrian' => 'required|',
            'loket_id' => 'required|',
        ]);

        if ($validator->fails()) {
            return Response([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => []
            ], 500);
        }

        $loket = Loket::where('id', $request->loket_id)->where('loket_antrian', 1)->pluck('id');

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
        
        
        $antrian = new Antrian;

        $antrian->tanggal_booking = now();
        $antrian->loket_id = $idLok;
        $antrian->nama = $request->nama;
        $antrian->nik = $request->nik;
        $antrian->no_telp = $request->no_telp;
        $antrian->tanggal_antrian = $request->tanggal_antrian;
        $antrian->waktu_antrian = $request->waktu_antrian;
        $antrian->jenis_antrian = 0;
        $antrian->status_antrian = 0;
        $antrian->no_antrian = $finalNoAntri;
        $antrian->alamat = $request->alamat;
        $antrian->rt = $request->rt;
        $antrian->rw = $request->rw;
        $antrian->urban_id = $request->urban_id;
        $antrian->district_id = $request->district_id;
        $antrian->city_id = $request->city_id;
        $antrian->province_id = $request->province_id;
        $antrian->longitude = $request->longitude;
        $antrian->latitude = $request->latitude;
        $antrian->patokan = $request->patokan;

        $dataAntri = Antrian::where('tanggal_antrian',$request->tanggal_antrian)->where('waktu_antrian',$request->waktu_antrian)->where('loket_id',$idLok)->get();
        $antriQ = Antrian::where('nik',$request->nik)->where('tanggal_antrian',$request->tanggal_antrian)->with('loket.layanan')->get()->pluck('loket.layanan.id');
        // dd(count($antriQ));
        if(count($antriQ) > 0 )
        {
            return Response([
                'status' => 'false',
                'message' => 'Harap Selesaikan Antrian Anda Terlebih Dahulu',
            ], 401);
        }
        else{
            if(count($dataAntri) > 0)
                {
                    return Response([
                        'status' => 'false',
                        'message' => 'Silahkan Pilih Waktu yang Lain',
                    ], 401);
                }
        }
        
        $antrian->save();

        return Response([
            'status' => 'success',
            'message' => 'Input data berhasil',
            'data' => $antrian
        ], 200);

    }

    public function historyAntrian($nik)
    {
        $antrian = Antrian::where('nik', $nik)->with('loket.layanan.opd')->orderBy('id','desc')->get();
       

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'antrian' => $antrian,
           
        ], 200);
    }

    public function homeAntrian($nik)
    {
        $antrian = Antrian::where('nik', $nik)->with('loket.layanan.opd')->orderBy('id', 'desc')->limit(5)->get();

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'antrian' => $antrian
        ], 200);
    }

    public function pengaju()
    {
        $antrian = Antrian::with('loket.layanan','userDoc')->get();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'antrian' => $antrian
        ], 200);
    }
}
