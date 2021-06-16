<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\Opd;
use App\Models\Loket;
use App\Models\Antrian;
use PDF;
use Carbon\Carbon;

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

    public function exportPDF()
    {
        $data = Loket::with(['layanan.opd', 'antrian'])->layananDinas()->get();
        $pdf = PDF::loadView('pdf_view', compact('data'));
        // download PDF file with download method
        return $pdf->download('report_harian.pdf');
    }
    public function exportPDFMonth()
    {
        $data = Antrian::with('loket.layanan')->selectRaw('loket_id, count(*) as total')->whereMonth('tanggal_antrian', Carbon::now()->month)->groupBy('loket_id')->get();
        $pdf = PDF::loadView('pdf_viewMonth', compact('data'));
        // print_r($data);exit;
        // download PDF file with download method
        return $pdf->download('report_bulanan.pdf');
        
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


        return redirect()->route('loket.antrians.index');
    }

    public function hapusLoket(Request $request)
    {
        $loket = Loket::find($request->idLoket);
        $loket->status_loket = 0;
        $loket->save();

        return redirect()->route('loket.antrians.index');
    }

    public function statusAntrian(Request $request)
    {
        $loket = Antrian::find($request->idAntrian);
        $loket->status_antrian = 2;
        $loket->save();

        return redirect()->route('loket.antrians.index');
    }

    public function hapusAntrian(Request $request)
    {
        $loket = Antrian::find($request->idAntrian);
        $loket->status_antrian = 3;
        $loket->save();

        return redirect()->route('loket.antrians.index');
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
        $loket->loket_antrian = $request->loket_antrian;

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
        $loket = Loket::where('id', $id)->get();
        $layanan = Layanan::dinas()->get();

        return view('loket.edit',compact('loket','layanan'));
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
        $loket = Loket::find($id);
        
        $loket->nama_loket = $request->nama_loket;
        $loket->layanan_id = $request->nama_layanan;
        $loket->nama_petugas = $request->nama_petugas;
        $loket->interval_waktu = $request->interval_waktu;
        $loket->interval_booking = 30;
        $loket->waktu_buka = $request->waktu_buka;
        $loket->waktu_tutup = $request->waktu_tutup;
        $loket->loket_antrian = $request->loket_antrian;

        $loket->save();
        return redirect()->route('dinas.lokets.index')->with('status','new Loket has Been Updated');


    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loket = Loket::find($id);
        $loket->delete();

        return redirect()->route('dinas.lokets.index')->with('status','new Loket has Been Deleted');

    }

    public function scanQr ()
    {
        return view ('scanQrCode');
    }

    public function mobilePrint(Request $request)
    {
        $res = $request->get('qrCode');
        $antri = Antrian::where('id',$res)->update(['status_antrian' => 1]);
        $antrix = Antrian::where('id',$res)->with('loket')->get();

        $loket_id = Antrian::where('id',$res)->pluck('loket_id');
        $loks = Loket::where('id',$loket_id)->get();

        $layanan_id = Loket::where('id',$loket_id)->pluck('layanan_id');
        $layanan = Layanan::where('id',$layanan_id)->get();

        $opd_id = Layanan::where('id',$layanan_id)->pluck('opd_id');
        $opd = Opd::where('id', $opd_id)->get();

        // dd($loks);
        return view ('printNomor',compact('antrix','loks','layanan','opd'));
    }

    public function MobileLoket($layanan)
    {  
        $loket = Loket::where('layanan_id', $layanan)->with('layanan')->get();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $loket
        ], 200);
    }
        
}
