<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Opd;
use App\Models\Layanan;
use App\Models\Loket;
use App\Models\Antrian;
use PDF;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // $loket = Loket::with('layanan')->pluck('id');
        // $antrian = Antrian::select('loket_id')->groupBy('loket_id')->count();
        $antrian = Antrian::with('loket.layanan')->selectRaw('loket_id, count(*) as total')->groupBy('loket_id')->get();

        
        // dd($loket);
        return view('home',compact('antrian'));
    }
}
