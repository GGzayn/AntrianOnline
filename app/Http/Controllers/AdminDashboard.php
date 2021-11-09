<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Opd;
use App\Models\Layanan;
use App\Models\Loket;
use App\Models\Antrian;
use App\Models\UserDocuments;
use PDF;
use Auth;
use Carbon\Carbon;

class AdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loket = Loket::where('child_id',auth()->user()->child_id)->with('layanan','antrian')->get();
        // $berkas = Loket::where('child_id',auth()->user()->child_id)->with('layanan','antrian.userDoc')->get();

        $berkasProses = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 0);
            });
        })->count();
        $berkasTerima = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1);
            });
        })->count();

        $berkasTolak = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 2);
            });
        })->count();

        $prosesDinas = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',0);
            });
        })->count();

        $berkasCetak = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',1);
            });
        })->count();

        $berkasKelurahan = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',2);
            });
        })->count();

        $pickup = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',3);
            });
        })->count();

        $antar = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',4);
            });
        })->count();

        $terkirim = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',5);
            });
        })->count();

        $gagal = Loket::where('child_id',auth()->user()->child_id)->whereHas('antrian', function($q)
        {
            $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
            {
                $e->where('status_berkas','=', 1)->where('status_pengiriman','=',6);
            });
        })->count();
        
        

        return view('dashboard',compact('loket','berkasProses','berkasTerima','berkasTolak','berkasCetak','prosesDinas','berkasKelurahan','pickup','antar','terkirim','gagal'));
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
}
