<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\UserDocuments;
use App\Models\NotifDocuments;
Use App\Models\Antrian;
Use App\Models\Loket;
use Carbon\Carbon;


class DocumentController extends Controller
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
            $data = UserDocuments::where('status_berkas',1)->with('antrian')->get();
            // $data = Loket::where('child_id',auth()->user()->child_id)->with('antrian.userDoc')->get();
            return view('opd_berkas.index',compact('data'));
        }
        elseif($role == 4)
        {
            $data = Loket::where('child_id',auth()->user()->child_id)->with('antrian.userDoc')->get();
            return view('kec_berkas.index',compact('data'));
        }
        
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
        $data = UserDocuments::where('id',$id)->get();
        return view ('kec_berkas.edit',compact('data'));
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
        $doc = UserDocuments::find($id);

        $doc->status_berkas = $request->status_berkas;
        $doc->note = $request->note;
        $doc->status_baca = false;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $request->status_berkas;
        $not->note = $doc->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();

        $role = auth()->user()->role->id;
        if ($role == 2) 
        {
            return redirect()->route('dinas.documents.index')->with('status','Berkas Telah DiPerbarui');
        }
        elseif($role == 4)
        {
            return redirect()->route('kecamatan.documents.index')->with('status','Berkas Telah DiPerbarui');
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
        //
    }

    public function get_berkas($id)
    {
        $doc = Antrian::with('notifDoc')->where('id', $id)->get();

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $doc
        ], 200);
    }

    public function post_berkas(Request $request)
    {
        $doc = NotifDocuments::find($request->id);
        $doc->status_baca = true;
        $doc->save();

        return Response([
            'status' => 'success',
        ], 200);
    }

    public function berkas_kirim(Request $request)
    {
        $data = UserDocuments::find($request->idBerkas);
        $data->status_pengiriman = 1;
        $data->save();

        $not = new NotifDocuments;
        $not->antrian_id = $data->antrian_id;
        $not->status_berkas = $data->status_berkas;
        $not->note = $data->note;
        $not->status_baca = false;
        $not->status_pengiriman = $data->status_pengiriman;
        $not->save();

        return redirect()->route('dinas.documents.index')->with('status','Berkas Telah DiPerbarui');
    }

    public function report_v()
    {
        return view('laporan.index');
    }


    public function report(Request $request)
    {
        
        $exp = explode(' - ',$request->reservation);
        $start = $exp[0];
        $end = $exp[1];
        $doc = UserDocuments::whereBetween('created_at', [$start, $end])->with('antrian')->get();
        return view('laporan.data',compact('doc'));
    }

    public function g_berkas()
    {
        $doc = UserDocuments::where('status_pengiriman',1)->with('antrian')->get();
        return Response([
            'status' => true,
            'message' => 'Pengambilan data berhasil',
            'data' => $doc,
        ], 200);
    }

    public function kirim_berkas($id)
    {
        $doc = UserDocuments::find($id);
        $doc->status_pengiriman = 3;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $doc->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();


        return Response([
            'status' => true,
            'message' => 'Berkas Sedang Dikirim',
            'layanan' => $doc,
        ], 200);

    }

    public function berkas_selesai($id)
    {
        $doc = UserDocuments::find($id);
        $doc->status_pengiriman = 4;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $doc->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();


        return Response([
            'status' => true,
            'message' => 'Berkas Telah Sampai',
            'layanan' => $doc,
        ], 200);
    }

    public function terima_berkas($id)
    {
        $doc = UserDocuments::find($id);
        $doc->status_pengiriman = 5;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $doc->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();

        return Response([
            'status' => true,
            'message' => 'Berkas Sudah Diterima Masyarakat',
            'layanan' => $doc,
        ], 200);
    }


    public function c_berkas()
    {
        $data = Loket::where('child_id',auth()->user()->child_id)->with('antrian.userDoc')->get();
        return view('berkasTercetak',compact('data'));
    }

    public function ck_berkas(Request $request)
    {
        $doc = UserDocuments::find($request->idBerkas);
        $doc->status_pengiriman = 2;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $doc->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();

        return redirect()->route('kecamatan.berkasTercetak')->with('status','Berkas Telah DiPerbarui');
    }

    public function kelurahan_berkas()
    {
        $data = Loket::where('child_id',auth()->user()->child_id)->with('antrian.userDoc')->get();
        return view('kel_berkas',compact('data'));
    }

    public function kk_berkas(Request $request)
    {
        $doc = UserDocuments::find($request->idBerkas);
        $doc->status_pengiriman = 3;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $doc->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();

        return redirect()->route('kelurahan.kelurahanBerkas')->with('status','Berkas Telah DiPerbarui');
    }
    
}
