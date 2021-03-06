<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Layanan;
use App\Models\Antrian;
use App\Models\Opd;
use App\Models\Loket;
use App\Models\Districts;
use App\Models\Urbans;

class OfflineRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('customer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = auth()->user()->role->id;
        $child = auth()->user()->child_id;
        if ($role == 2) {
            $layanan = Layanan::with('opd')->has('loketOff')->dinas()->get();

            return view ('offlineRegister',compact('layanan'));
        }
        elseif($role == 4)
        {
            $layanan = Layanan::where('opd_id',2)->has('loketOff')->get();
            $data = Urbans::where('district_id', $child)->get();

            return view ('offlineRegister',compact('layanan','data'));
        }
        elseif($role == 8)
        {
            $layanan = Layanan::where('opd_id',3)->has('loketOff')->get();
            $kecamatan = Districts::where('upt_id',$child)->get();

            $kelurahan = Urbans::whereHas('district', function ($query) use($child) {
                $query->where('upt_id', '=', $child);
            })->get();

            return view ('offlineRegister',compact('layanan','kecamatan','kelurahan'));
        }
        
       
    }

    public function getUrban($id)
    {
        $urban = Urbans::where('district_id',$id)->pluck('id','urban');
        return response()->json($urban);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loket = Loket::where('layanan_id', $request->layanan_id)->where('loket_antrian', 2)->pluck('id');
        $kodelay = Layanan::where('id',$request->layanan_id)->pluck('kode_layanan');
        $antrian = Antrian::selectRaw('loket_id, count(*) as total')->whereIn('loket_id', $loket)->groupBy('loket_id')->get()->pluck('total', 'loket_id');
        
        $loket_id = $loket[0];
        if (count($antrian) > 0) {
            $minTotal = 1;
            foreach ($loket as $k => $v) {
                if (!isset($antrian[$v])) {
                    $loket_id = $v;
                    break;
                }
                if ($minTotal >= $antrian[$v]) {
                    continue;
                }
                $minTotal = $antrian[$v];
                $loket_id = $v;
            }
        }

        $lok = Loket::find($loket_id);
        $datenow = strtotime(date('Y-m-d H:i:s'));

        // Get different minutes of open and close time
        $start = strtotime($lok->waktu_buka);
        $end = strtotime($lok->waktu_tutup);
        $mins = ($end - $start) / 60;

        $interval_mins = $lok->interval_waktu;
        $m = 0;
        while ($m <= $mins) {
            $x = strtotime(date('Y-m-d H:i:s', $start).' + '.$m.' minutes');
            $value = date('H:i:s', $x);
            $m += $interval_mins;
            if ($x <= $datenow) {
                continue;
            } elseif ($x >= $end) {
                break;
            }
            $result[] = $value;
            
        }
        if(!isset($result))
        {
            $role = auth()->user()->role->id;
            if($role == 2)
            {
                return redirect()->route('dinas.offlines.index')->with('error','Mohon Maaf Antrian Hari ini Sudah Penuh!');
            }
            elseif($role == 4)
            {
                return redirect()->route('kecamatan.offlines.index')->with('error','Mohon Maaf Antrian Hari ini Sudah Penuh!');
                
            }
            elseif($role == 8)
            {
                return redirect()->route('adminUpt.offlines.index')->with('error','Mohon Maaf Antrian Hari ini Sudah Penuh!');
                
            }
        }
        else{
            $data_antrian = Antrian::selectRaw('CAST(waktu_antrian AS char) AS waktu_antrian_text')->where('loket_id', $loket_id)->get()->pluck('waktu_antrian_text')->toArray();
            $diff_array = array_diff($result, $data_antrian);
            $waktu_antrian = $diff_array[array_key_first($diff_array)];
            $nomAntri = count($data_antrian) +1;
            foreach($kodelay as $r)
            {
                $has = $r;
            }
            
            $finalNoAntri = "$has - $nomAntri";

            $role = auth()->user()->role->id;
            if($role == 2)
            {
                $antrian = new Antrian;
                $antrian->tanggal_booking = now();
                $antrian->loket_id = $loket_id;
                $antrian->nama = $request->nama;
                $antrian->nik = $request->nik;
                $antrian->tanggal_antrian = now();
                $antrian->waktu_antrian = substr($waktu_antrian, 0, -3);
                $antrian->jenis_antrian = 1;
                $antrian->status_antrian = 1;
                $antrian->province_id = 36;
                $antrian->city_id = 3603;
                $antrian->alamat = $request->alamat;
                $antrian->rt = $request->rt;
                $antrian->rw = $request->rw;
                $antrian->no_antrian = $finalNoAntri;
                $antrian->save();

                return redirect()->route('dinas.offlines.index')->with('status','Terima Kasih, Silahkan Menunggu Nomor Antrian Anda Dipanggil');
            }
            elseif($role == 4)
            {
                $antrian = new Antrian;
                $antrian->tanggal_booking = now();
                $antrian->loket_id = $loket_id;
                $antrian->nama = $request->nama;
                $antrian->nik = $request->nik;
                $antrian->tanggal_antrian = now();
                $antrian->waktu_antrian = substr($waktu_antrian, 0, -3);
                $antrian->jenis_antrian = 1;
                $antrian->status_antrian = 1;
                $antrian->alamat = $request->alamat;
                $antrian->rt = $request->rt;
                $antrian->rw = $request->rw;
                $antrian->province_id = 36;
                $antrian->city_id = 3603;
                $antrian->district_id = auth()->user()->child_id;
                $antrian->urban_id = $request->kelurahan;
                $antrian->no_antrian = $finalNoAntri;
                $antrian->save();

                return redirect()->route('kecamatan.offlines.index')->with('status','Terima Kasih, Silahkan Menunggu Nomor Antrian Anda Dipanggil');
            }
            elseif($role == 8)
            {
                $antrian = new Antrian;
                $antrian->tanggal_booking = now();
                $antrian->loket_id = $loket_id;
                $antrian->nama = $request->nama;
                $antrian->nik = $request->nik;
                $antrian->tanggal_antrian = now();
                $antrian->waktu_antrian = substr($waktu_antrian, 0, -3);
                $antrian->jenis_antrian = 1;
                $antrian->status_antrian = 1;
                // $antrian->alamat = $request->alamat;
                // $antrian->rt = $request->rt;
                // $antrian->rw = $request->rw;
                // $antrian->nop = $request->nop;
                $antrian->province_id = 36;
                $antrian->city_id = 3603;
                // $antrian->district_id = $request->kecamatan;
                // $antrian->urban_id = $request->kelurahan;
                // $antrian->nama_wp = $request->nama_wp;
                // $antrian->jumlah_berkas = $request->jumlah_berkas;
                $antrian->no_antrian = $finalNoAntri;
                $antrian->save();

                return redirect()->route('adminUpt.offlines.index')->with('status','Terima Kasih, Silahkan Menunggu Nomor Antrian Anda Dipanggil');
            }
            
        }
        

        

        
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

    public function MobileTimeAvail(Request $request)
    {

        $loket = Loket::where('id', $request->loket_id)->where('loket_antrian', 1)->pluck('id');
        $antrian = Antrian::selectRaw('loket_id, count(*) as total')->whereIn('loket_id', $loket)->where('tanggal_antrian', $request->tanggal_antrian)->groupBy('loket_id')->get()->pluck('total', 'loket_id');
        
        $loket_id = $loket[0];
        // dd($loket_id);
        
        if (count($antrian) > 0) {
            $minTotal = 1;
            foreach ($loket as $k => $v) {
                if (!isset($antrian[$v])) {
                    $loket_id = $v;
                    break;
                }
                if ($minTotal >= $antrian[$v]) {
                    continue;
                }
                $minTotal = $antrian[$v];
                $loket_id = $v;
            }
        }
        
        
        $lok = Loket::find($loket_id);
        $datenow = strtotime($request->tanggal_antrian);
        
        
        // Get different minutes of open and close time
        $start = strtotime($lok->waktu_buka);
        $end = strtotime($lok->waktu_tutup);
        $mins = ($end - $start) / 60;
        
        $interval_mins = $lok->interval_waktu;
        $m = 0; 
        while ($m <= $mins) {
            $x = strtotime(date('Y-m-d H:i:s', $start).' + '.$m.' minutes');
            $value = date('H:i:s', $x);
            $m += $interval_mins;
            if($datenow == null )
            {
                return Response([
                    'status' => 'error', 
                    'message' => 'Silahkan Pilih Tanggal Antrian yang Benar',
                ],401);
            }
            elseif($datenow <= $x)
            {
                return Response([
                    'status' => 'error', 
                    'message' => 'Anda Tidak Bisa Memilih Antrian di Tanggal Tersebut!',
                ],401);
            }
            else{
                if ($x >= $datenow) {
                    continue;
                } 
            }
            
            $result[] = $value;
        }
       
        
        $data_antrian = Antrian::selectRaw('CAST(waktu_antrian AS char) AS waktu_antrian_text')->where('tanggal_antrian', $request->tanggal_antrian)->where('loket_id', $loket_id)->get()->pluck('waktu_antrian_text')->toArray();
        $diff_array = array_diff($result, $data_antrian);
        $waktu_antrian = $diff_array[array_key_first($diff_array)];
        $p =0;
        foreach($diff_array as $row => $v)
        {
            $how[] = $v;
        }
        // dd($how);

        return Response([
            'status' => 'success', 
            'message' => 'Pengambilan data berhasil',
            'waktu' => $how,
        ], 200);
    }

    
}
