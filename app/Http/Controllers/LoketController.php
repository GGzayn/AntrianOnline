<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\Opd;
use App\Models\Loket;
use App\Models\Antrian;
use App\Models\Districts;
use App\Models\UserDocuments;
use App\Models\NotifDocuments;
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
        if ($role == 2) {
            $data = Loket::where('child_id',auth()->user()->child_id)->with(['layanan.opd', 'antrian'])->layananDinas()->paginate(10);
        }
        elseif($role == 4)
        {
            $data = Loket::where('child_id',auth()->user()->child_id)->with('district','layanan.opd','antrian')->paginate(10);
        }
        return view ('loket.index',compact('data'));
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
        // $data = Antrian::with('loket.layanan.opd')->selectRaw('loket_id, count(*) as total')->whereMonth('tanggal_antrian', Carbon::now()->month)->groupBy('loket_id')->get();
        $data = Loket::with(['layanan.opd', 'antrian'])->layananDinas()->get();
        $pdf = PDF::loadView('pdf_viewMonth', compact('data'));
        // dd($data);
        // download PDF file with download method
        return $pdf->download('report_bulanan.pdf');
        
    }

    public function liveAntrian()
    {
        $role = auth()->user()->role->id;
        if ($role == 2) {
            $data = Loket::where('child_id',auth()->user()->child_id)->where('status_loket',1)->with(['layanan.opd', 'antrian'])->layananDinas()->get();
        }
        elseif($role == 4)
        {
            $data = Loket::where('child_id',auth()->user()->child_id)->where('status_loket',1)->with('district','layanan.opd','antrian')->get();
        }
        

        return view ('live',compact('data'));
    }

    public function statusLoket(Request $request)
    {
        
        $loket = Loket::find($request->idLoket);
        $loket->status_loket = 1;
        $loket->save();

        $role = auth()->user()->role->id;
        if ($role == 3) {
            $data2 = Loket::where('child_id',auth()->user()->where('status_loket',1)->child_id)->with(['layanan.opd', 'antrian'])->layananDinas()->get();
        }
        elseif($role == 5)
        {
            $data2 = Loket::where('child_id',auth()->user()->child_id)->where('status_loket',1)->with('district','layanan.opd','antrian')->get();
        }
        
        if($loket == null)
        {
            return redirect()->route('loket.antrians.index')->with('error','SIlahkan Pilih Loket Terlebih Dahulu');
        }
        return view('loketLive', compact('data2'));
    }

    public function hapusLoket(Request $request)
    {
        $loket = Loket::find($request->idLoket);
        $loket->status_loket = 0;
        $loket->save();

        $role = auth()->user()->role->id;
        if ($role == 3) {
            return redirect()->route('loket.antrians.index');
        }
        elseif($role == 5)
        {
            return redirect()->route('loketKecamatan.antrians.index');
        }

        
    }

    public function statusAntrian(Request $request)
    {
        $loket = Antrian::find($request->idAntrian);
        $loket->status_antrian = 2;
        $loket->save();

        $role = auth()->user()->role->id;
        if ($role == 3) {
            $data2 = Loket::where('child_id',auth()->user()->where('status_loket',1)->child_id)->with(['layanan.opd', 'antrian'])->layananDinas()->get();
        }
        elseif($role == 5)
        {
            $data2 = Loket::where('child_id',auth()->user()->child_id)->where('status_loket',1)->with('district','layanan.opd','antrian')->get();
        }
        return view('loketLive', compact('data2'));
    }

    public function hapusAntrian(Request $request)
    {
        $loket = Antrian::find($request->idAntrian);
        $loket->status_antrian = 3;
        $loket->save();

        $doc = new UserDocuments;
        $doc->antrian_id = $request->idAntrian;
        $doc->status_berkas = 0;
        $doc->status_baca = false;
        $doc->status_pengiriman =0;

        $doc->save();

        $doc = new NotifDocuments;;
        $doc->antrian_id = $request->idAntrian;
        $doc->status_berkas = 0;
        $doc->status_baca = false;
        $doc->status_pengiriman =0;

        $doc->save();

        $role = auth()->user()->role->id;
        if ($role == 3) {
            $data2 = Loket::where('child_id',auth()->user()->where('status_loket',1)->child_id)->with(['layanan.opd', 'antrian'])->layananDinas()->get();
        }
        elseif($role == 5)
        {
            $data2 = Loket::where('child_id',auth()->user()->child_id)->where('status_loket',1)->with('district','layanan.opd','antrian')->get();
        }
        
        return view('loketLive', compact('data2'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = auth()->user()->role->id;
        if($role == 2)
        {
            $layanan = Layanan::dinas()->get();
        }
        elseif($role == 4)
        {
            $layanan = Layanan::get();
        }
        
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
        $loket->child_id = auth()->user()->child_id;
        $loket->nama_petugas = $request->nama_petugas;
        $loket->interval_waktu = $request->interval_waktu;
        $loket->interval_booking = 30;
        $loket->waktu_buka = $request->waktu_buka;
        $loket->waktu_tutup = $request->waktu_tutup;
        $loket->loket_antrian = $request->loket_antrian;

        $loket->save();

        $role = auth()->user()->role->id;
        if($role == 2)
        {
            return redirect()->route('dinas.lokets.index')->with('status','new Loket has Been Created');
        }
        elseif($role == 4)
        {
            return redirect()->route('kecamatan.lokets.index')->with('status','new Loket has Been Created');
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
        $role = auth()->user()->role->id;
        if($role == 2)
        {
            $loket = Loket::where('id', $id)->get();
            $layanan = Layanan::dinas()->get();
        }
        elseif($role == 4)
        {
            $loket = Loket::where('id', $id)->get();
            $layanan = Layanan::get();
        }
        
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
        $loket->child_id = auth()->user()->child_id;
        $loket->nama_petugas = $request->nama_petugas;
        $loket->interval_waktu = $request->interval_waktu;
        $loket->interval_booking = 30;
        $loket->waktu_buka = $request->waktu_buka;
        $loket->waktu_tutup = $request->waktu_tutup;
        $loket->loket_antrian = $request->loket_antrian;

        $loket->save();
        $role = auth()->user()->role->id;
        if($role == 2)
        {
            return redirect()->route('dinas.lokets.index')->with('status','new Loket has Been Updated');
        }
        elseif($role == 4)
        {
            return redirect()->route('kecamatan.lokets.index')->with('status','new Loket has Been Updated');
        }


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

        $role = auth()->user()->role->id;
        if($role == 2)
        {
            return redirect()->route('dinas.lokets.index')->with('status','new Loket has Been Deleted');
        }
        elseif($role == 4)
        {
            return redirect()->route('kecamatan.lokets.index')->with('status','new Loket has Been Deleted');
        }

    }

    public function scanQr ()
    {
        return view ('scanQrCode');
    }

    public function mobilePrint(Request $request)
    {
        $res = $request->get('qrCode');
        $antri = Antrian::where('id',$res)->update(['status_antrian' => 1]);
        // $antrix = Antrian::where('id',$res)->with('loket')->get();

        // $loket_id = Antrian::where('id',$res)->pluck('loket_id');
        // $loks = Loket::where('id',$loket_id)->get();

        // $layanan_id = Loket::where('id',$loket_id)->pluck('layanan_id');
        // $layanan = Layanan::where('id',$layanan_id)->get();

        // $opd_id = Layanan::where('id',$layanan_id)->pluck('opd_id');
        // $opd = Opd::where('id', $opd_id)->get();

        // dd($loks);
        return view ('afterScan');
    }

    public function MobileLoket($id)
    {  
        $loket = Loket::where('child_id', $id)->where('loket_antrian',1)->with('layanan.opd','district')->get();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $loket
        ], 200);
    }
        
}
