<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\Antrian;
use App\Models\Opd;
use App\Models\Loket;

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
        $layanan = Layanan::with('opd')->dinas()->get();
        return view ('offlineRegister',compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loket = Loket::where('layanan_id', $request->layanan_id)->pluck('id');
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

        $data_antrian = Antrian::selectRaw('CAST(waktu_antrian AS char) AS waktu_antrian_text')->where('loket_id', $loket_id)->get()->pluck('waktu_antrian_text')->toArray();
        $diff_array = array_diff($result, $data_antrian);
        $waktu_antrian = $diff_array[array_key_first($diff_array)];


        $antrian = new Antrian;

        $antrian->tanggal_booking = now();
        $antrian->loket_id = $loket_id;
        $antrian->nama = $request->nama;
        $antrian->nik = $request->nik;
        $antrian->tanggal_antrian = now();
        $antrian->waktu_antrian = substr($waktu_antrian, 0, -3);
        $antrian->jenis_antrian = 1;
        $antrian->status_antrian = 1;
        $antrian->no_antrian = count($data_antrian) + 1;

        $antrian->save();
        $nik = $antrian->nik;
        $nama = $antrian->nama;

        return view ('offlineCheck',compact('nik','nama'));
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
}
