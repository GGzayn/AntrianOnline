<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\UserDocuments;
use App\Models\NotifDocuments;
Use App\Models\Antrian;
Use App\Models\Loket;
Use App\Models\Districts;
Use App\Models\Urbans;
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
        $child = auth()->user()->child_id;
        if ($role == 2 ) {
            $data = UserDocuments::where('status_berkas',1)->where('status_pengiriman',8)->with('antrian')->orderBy('id','DESC')->get();
            $newBerkas = Loket::whereHas('layanan',function($l) use($child)
                {
                    $l->where('opd_id',$child);
                })
                ->whereHas('antrian', function($q)
                {
                    $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
                    {
                        $e->where('status_berkas','=', 1)->where('status_pengiriman','=',8);
                    });
                })->count();
            return view('opd_berkas.index',compact('data','newBerkas'));
        }
        elseif($role == 4 || $role == 8 )
        {
            $data = Loket::where('child_id',auth()->user()->child_id)->with('antrian.userDoc')->orderBy('id','DESC')->get();
            $newBerkas = UserDocuments::where('status_berkas',0)->with(['antrian.loket.upt','antrian.loket.district'])->whereHas('antrian', function($a) use($child)
            {
                $a->where('status_antrian',3)->whereHas('loket', function($l) use($child) 
                {
                    $l->where('child_id', $child);
                });
            })->count();
            return view('kec_berkas.index',compact('data','newBerkas'));
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
        $not->note = $request->note;
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
        elseif($role == 8)
        {
            return redirect()->route('adminUpt.documents.index')->with('status','Berkas Telah DiPerbarui');
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

        foreach($doc as $row)
        {
            $docs = $row;
        }

        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $docs
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
        if(isset($_POST['terima']))
        {
            $data = UserDocuments::find($request->idBerkas);
            $data->status_pengiriman = 1;
            $data->save();
    
            $not = new NotifDocuments;
            $not->antrian_id = $data->antrian_id;
            $not->status_berkas = $data->status_berkas;
            $not->note = $request->note;
            $not->status_baca = false;
            $not->status_pengiriman = $data->status_pengiriman;
            $not->save();
        }
        elseif(isset($_POST['tolak']))
        {
            $data = UserDocuments::find($request->idBerkas);
            $data->status_pengiriman = 0;
            $data->status_berkas = 4; //berkas ditolak oleh Dinas
            $data->note = $request->note;
            $data->status_baca = false;
            $data->save();

            $not = new NotifDocuments;
            $not->antrian_id = $data->antrian_id;
            $not->status_berkas = $data->status_berkas;
            $not->note = $request->note;
            $not->status_baca = false;
            $not->status_pengiriman = $data->status_pengiriman;
            $not->save();
        }
        

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
        $doc = UserDocuments::whereBetween('updated_at', [$start, $end])->with('antrian.loket.layanan')->get();
        return view('laporan.data',compact('doc'));
    }

    public function g_berkas()
    {
        $doc = UserDocuments::where('status_pengiriman',2)->with('antrian')->get();
        return Response([
            'status' => true,
            'message' => 'Pengambilan data berhasil',
            'data' => $doc,
        ], 200);
    }

    public function status_kirim(Request $request, $id)
    {
        $doc = UserDocuments::where('antrian_id',$id)->first();
        $doc->status_pengiriman = $request->status_pengiriman;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $request->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();


        return Response([
            'status' => true,
            'message' => 'Status Pengiriman Berhasil Dirubah',
            'data' => $doc,
        ], 200);

    }

    public function c_berkas()
    {
        $dataOnline = UserDocuments::where('status_berkas',1)->where('status_pengiriman',1)->with('antrian.loket')
        ->whereHas('antrian',function($a){
            $a->where('jenis_antrian',0)->whereHas('loket',function($l){
                $l->where('child_id',auth()->user()->child_id);
            });
        })
        ->get();
        $dataOffline = UserDocuments::where('status_berkas',1)->where('status_pengiriman',1)->with('antrian.loket')
        ->whereHas('antrian',function($a){
            $a->where('jenis_antrian',1)->whereHas('loket',function($l){
                $l->where('child_id',auth()->user()->child_id);
            });
        })
        ->get();
        $newBerkasOnline = UserDocuments::where('status_berkas',1)->where('status_pengiriman',1)->with('antrian.loket')
        ->whereHas('antrian',function($a){
            $a->where('jenis_antrian',0)->whereHas('loket',function($l){
                $l->where('child_id',auth()->user()->child_id);
            });
        })
        ->count();

        $newBerkasOffline = UserDocuments::where('status_berkas',1)->where('status_pengiriman',1)->with('antrian.loket')
        ->whereHas('antrian',function($a){
            $a->where('jenis_antrian',1)->whereHas('loket',function($l){
                $l->where('child_id',auth()->user()->child_id);
            });
        })
        ->count();
        return view('berkasTercetak',compact('dataOnline','dataOffline','newBerkasOnline','newBerkasOffline'));
    }

    public function ck_berkas(Request $request)
    {
        if(isset($_POST['petugas']))
        {
            $doc = UserDocuments::find($request->idBerkas);
            $doc->status_pengiriman = 2;
            $doc->save();

            $not = new NotifDocuments;
            $not->antrian_id = $doc->antrian_id;
            $not->status_berkas = $doc->status_berkas;
            $not->note = $request->note;
            $not->status_baca = false;
            $not->status_pengiriman = $doc->status_pengiriman;
            $not->save();
        }
        elseif(isset($_POST['masyarakat']))
        {
            $doc = UserDocuments::find($request->idBerkas);
            $doc->status_pengiriman = 5;
            $doc->save();

            $not = new NotifDocuments;
            $not->antrian_id = $doc->antrian_id;
            $not->status_berkas = $doc->status_berkas;
            $not->note = $request->note;
            $not->status_baca = false;
            $not->status_pengiriman = $doc->status_pengiriman;
            $not->save();
        }
        

        $role = auth()->user()->role->id;
        if ($role == 4)
        {
            return redirect()->route('kecamatan.berkasTercetak')->with('status','Berkas Telah DiPerbarui');
        }
        elseif($role == 8)
        {
            return redirect()->route('adminUpt.berkasTercetak')->with('status','Berkas Telah DiPerbarui');
        }

        
    }

    public function kelurahan_berkas()
    {   
        $kec = Urbans::where('id',auth()->user()->child_id)->pluck('district_id');
        $data = Loket::where('child_id',$kec[0])->with('antrian.userDoc')->get();
        $newBerkas = UserDocuments::Where('status_pengiriman',2)->count();
        return view('kel_berkas',compact('data','newBerkas'));
    }

    public function kk_berkas(Request $request)
    {
        $doc = UserDocuments::find($request->idBerkas);
        $doc->status_pengiriman = 3;
        $doc->save();

        $not = new NotifDocuments;
        $not->antrian_id = $doc->antrian_id;
        $not->status_berkas = $doc->status_berkas;
        $not->note = $request->note;
        $not->status_baca = false;
        $not->status_pengiriman = $doc->status_pengiriman;
        $not->save();

        return redirect()->route('kelurahan.kelurahanBerkas')->with('status','Berkas Telah DiPerbarui');
    }

    public function berkasMasuk()
    {
        $role = auth()->user()->role->id;
        $child = auth()->user()->child_id;
        if ($role == 2 ) {
            $data = UserDocuments::where('status_berkas',1)->where('status_pengiriman',0)->with('antrian')->orderBy('id','DESC')->get();
            $newBerkas = Loket::whereHas('layanan',function($l) use($child)
                {
                    $l->where('opd_id',$child);
                })
                ->whereHas('antrian', function($q)
                {
                    $q->where('status_antrian', '=', 3)->whereHas('userDoc',function($e)
                    {
                        $e->where('status_berkas','=', 1)->where('status_pengiriman','=',0);
                    });
                })->count();
            return view('opd_berkas.berkasMasuk',compact('data','newBerkas'));
        }
    }

    public function berkasKeluar(Request $request)
    {
            $data = UserDocuments::find($request->idBerkas);
            $data->status_pengiriman = 8;
            $data->save();
    
            $not = new NotifDocuments;
            $not->antrian_id = $data->antrian_id;
            $not->status_berkas = $data->status_berkas;
            $not->note = $request->note;
            $not->status_baca = false;
            $not->status_pengiriman = $data->status_pengiriman;
            $not->save();

            return redirect()->route('dinas.berkasMasuk')->with('status','Berkas Telah Diterima');
    }
    
}
