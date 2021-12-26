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
use App\Models\Districts;
use App\Models\Upt;
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
        $berkasProses = $berkasDiterima = $berkasDitolak =  $berkasTerkirim = $berkasGagalTerkirim = [];
        $proses = $diterima = $ditolak =  $kirim = $gagal = [];
        $totalAntrian1 = $totalAntrian2 = $totalAntrian3 = $totalAntrian4 = $totalAntrian5 = $berkasDitolakx =  0;
        $keca = $tot =  [];

        $child = auth()->user()->child_id;
        if ($child == 2) {
            $kecamatan = Districts::where('city_id',3603)->orderBy('district')->get()->pluck('district','id')->toArray();
            $kec = Districts::where('city_id',3603)->pluck('id','district');
            $doc = UserDocuments::with(['antrian','antrian.loket.district'])->get()->sortBy('antrian.loket.district.district');
            $antrian = Antrian::with(['loket.district','userDoc'])->whereHas('loket',function($l) use($child)
            {
                $l->wherehas('layanan',function($la) use($child)
                {
                    $la->where('opd_id',$child);
                });
            })->get()->groupBy('loket.district.id');

            foreach($antrian as $key => $item)
            {
                $tot[$key] = $item->count();
            }

            foreach($doc as $index => $item){
                if($item->status_berkas == 1){
                    $berkasDiterima[$item->antrian->loket->child_id][] = 1;
                } else if($item->status_berkas == 2){
                    $berkasDitolak[$item->antrian->loket->child_id][] = 1;
                    $berkasDitolakx[$item->antrian->loket->child_id]->count();
                }
                else if($item->status_berkas == 0){
                    $berkasProses[$item->antrian->loket->child_id][] = 1;
                }

                if($item->status_pengiriman == 5){
                    $berkasTerkirim[$item->antrian->loket->child_id][] = 1;
                } else if($item->status_pengiriman == 6){
                    $berkasGagalTerkirim[$item->antrian->loket->child_id][] = 1;
                }
            }

            foreach($kec as $nama => $id)
            {
                if(isset($tot[$id],$berkasDiterima[$id]) )
                {
                    $keca[$nama] = ['antrian' => $tot[$id],
                                    'bTerima'=> array_sum($berkasDiterima[$id]),
                                ];
                }
                else{
                    $keca[$nama] = ['antrian' => 0,'bTerima'=> 0];
                }
            }
            // return $keca;
            foreach($kecamatan as $id => $namaUpt){
                if(isset($berkasProses[$id])){
                    $proses[] = array_sum($berkasProses[$id]);
                } else {
                    $proses[] = 0;
                }

                if(isset($berkasDiterima[$id])){
                    $diterima[] = array_sum($berkasDiterima[$id]);
                } else {
                    $diterima[] = 0;
                }

                if(isset($berkasDitolak[$id])){
                    $ditolak[] = array_sum($berkasDitolak[$id]);
                } else {
                    $ditolak[] = 0;
                }

                if(isset($berkasTerkirim[$id])){
                    $kirim[] = array_sum($berkasTerkirim[$id]);
                } else {
                    $kirim[] = 0;
                }

                if(isset($berkasGagalTerkirim[$id])){
                    $gagal[] = array_sum($berkasGagalTerkirim[$id]);
                } else {
                    $gagal[] = 0;
                }
            }
            sort($kecamatan);
            $antrian = Antrian::with(['loket.district','userDoc'])
            ->whereHas('loket',function($e) use($child){
                $e->where('child_id','!=',$child)->groupBy('child_id')->whereHas('layanan',function($l) use($child){
                    $l->where('opd_id',$child);
                });
            })->get()->groupBy('loket.child_id');
            // return $gagal;
            return view('dashboardKecamatan',compact('kecamatan','diterima','ditolak','kirim','gagal','proses','keca'));
        }
        elseif($child == 3)
        {
            $layanan = Layanan::where('opd_id',$child)->count();
            $loks = Loket::whereHas('layanan',function($l) use($child){
                $l->where('opd_id',$child);
            })->count();
            $upt = Upt::orderBy('upt')->get()->pluck('upt','id')->toArray();

            $antrian = Antrian::with(['loket.upt','userDoc'])
                ->whereHas('loket',function($e) use($child){
                    $e->where('child_id','!=',$child)
                    ->whereHas('layanan',function($l) use($child){
                        $l->where('opd_id',$child);
                    });
                })->get()->groupBy('loket.child_id');

            $doc2 = UserDocuments::with(['antrian'])
                ->whereHas('antrian',function($a) use($child){
                    $a->whereHas('loket', function($lo) use($child) {
                        $lo->where('child_id','!=',$child)
                        ->whereHas('layanan', function($la) use($child){
                            $la->where('opd_id',$child);
                        });
                    });
            })->get()->groupBy('antrian.loket.upt.id');
            
            foreach($antrian as $id => $it)
            {  
                if ($id == 10001) {
                    $totalAntrian1 = $it->count();
                    $idupt1 = $id;
                }
                else if ($id == 10002) {
                    $totalAntrian2 = $it->count();
                    $idupt2 = $id;
                }
                else if ($id == 10003) {
                    $totalAntrian3 = $it->count();
                    $idupt3 = $id;
                }
                else if ($id == 10004) {
                    $totalAntrian4 = $it->count();
                    $idupt4 = $id;
                }
                else if ($id == 10005) {
                    $totalAntrian5 = $it->count();
                    $idupt5 = $id;
                }
            }
            $doc = UserDocuments::with(['antrian','antrian.loket.upt'])->get()->sortBy('antrian.loket.upt.upt');
            
            foreach($doc as $index => $item){
                if($item->status_berkas == 1){
                    $berkasDiterima[$item->antrian->loket->child_id][] = 1;
                } else if($item->status_berkas == 2){
                    $berkasDitolak[$item->antrian->loket->child_id][] = 1;
                }
                else if($item->status_berkas == 0){
                    $berkasProses[$item->antrian->loket->child_id][] = 1;
                }

                if($item->status_pengiriman == 5){
                    $berkasTerkirim[$item->antrian->loket->child_id][] = 1;
                } else if($item->status_pengiriman == 6){
                    $berkasGagalTerkirim[$item->antrian->loket->child_id][] = 1;
                }
            }
            foreach($upt as $id => $namaUpt){
                if(isset($berkasProses[$id])){
                    $proses[] = array_sum($berkasProses[$id]);
                } else {
                    $proses[] = 0;
                }
                if(isset($berkasDiterima[$id])){
                    $diterima[] = array_sum($berkasDiterima[$id]);
                } else {
                    $diterima[] = 0;
                }

                if(isset($berkasDitolak[$id])){
                    $ditolak[] = array_sum($berkasDitolak[$id]);
                } else {
                    $ditolak[] = 0;
                }

                if(isset($berkasTerkirim[$id])){
                    $kirim[] = array_sum($berkasTerkirim[$id]);
                } else {
                    $kirim[] = 0;
                }

                if(isset($berkasGagalTerkirim[$id])){
                    $gagal[] = array_sum($berkasGagalTerkirim[$id]);
                } else {
                    $gagal[] = 0;
                }
            }
            
            sort($upt);
            return view('dashboard',compact('loks','doc2','antrian','upt','diterima','ditolak','kirim','gagal','proses','layanan','totalAntrian1','totalAntrian2','totalAntrian3','totalAntrian4','totalAntrian5'));
        }
        
        // dd($antrian);
       
    }

    public function dashUpt()
    {
        $asu = $asus = [];
        $terims = $b_tolaks = $d_tolak = $t_lengkap = [];
        $months = array();
        for ($i = 0; $i < 13; $i++) {
            $timestamp = mktime(0, 0, 0, date('n') - $i, 1);
            $months[date('n', $timestamp)] = date('F', $timestamp);
        }
        
        $bulan = Antrian::selectRaw('DATE_FORMAT(tanggal_antrian,"%m") as bulan')->where('tanggal_antrian', "like", "%" . date('Y') . "%")->groupBy('bulan')->get()->pluck('bulan');
        $child = auth()->user()->child_id;
        $loket = Loket::where('child_id',$child)->pluck('id','nama_loket');
        $totalLoket = Loket::where('child_id',$child)->count();
        $totalBerkas = UserDocuments::with('antrian.loket')->whereHas('antrian',function($a) use($child){
            $a->whereHas('loket',function($l) use($child){
                $l->where('child_id',$child);
            });
        })->count();
        $totalAntrian = Antrian::whereHas('loket',function($l) use($child){
            $l->where('child_id',$child);
        })->count();
        $totalAntrianLoket = Antrian::selectRaw('loket_id, count(*) as total')->whereIn('loket_id', $loket)->groupBy('loket_id')->get()->pluck('total', 'loket_id');
        $totalAntrianBulanan = Antrian::selectRaw('DATE_FORMAT(tanggal_antrian,"%m") as bulan, count(*) as total')->where('tanggal_antrian', "like", "%" .date('Y') . "%")->whereIn('loket_id',$loket)->groupBy('bulan')->get()->pluck('total','bulan');
        
        foreach($totalAntrianBulanan as $bulans => $total)
        {  
            $hasil[$bulans] = $total;
            
        }
        foreach($months as $id => $bu){
            if (isset($hasil[$id])) {
                $val[] = $hasil[$id];
            }
            else{
                $val[] = 0; 
            }
            $namabul[] = $bu;
        }
        
        foreach($totalAntrianLoket as $id => $total)
        {
            $asu[$id] = $total;
        }
 
        foreach($loket as $id => $nama)
        {   
            $asus[] = array('value' => $asu[$nama], 'name' => 'Loket: '.$id.'');
        }
        $data = array(['value' => $totalBerkas , 'name'=>'TOTAL BERKAS'],['value' => $totalAntrian , 'name'=>'TOTAL ANTRIAN'],['value' => $totalLoket , 'name'=>'TOTAL LOKET']);
        
        $docu = UserDocuments::with('antrian.loket.upt')->whereHas('antrian',function($a) use($child){
            $a->whereHas('loket',function($l) use($child){
                $l->where('child_id',$child);
            });
        })->get();
        foreach($docu as $key => $items)
        {
            if($items->status_berkas == 1)
            {
                $bterima[$key] = 1;
                $terims = array_sum($bterima);
            }
            else if($items->status_berkas == 2)
            {
                $btolak[$key] = 1;
                $b_tolaks = array_sum($btolak);
            }
            else if($items->status_berkas == 3)
            {
                $bt_lengkap[$key] = 1;
                $t_lengkap = array_sum($bt_lengkap);
            }
            else if($items->status_berkas == 4)
            {
                $bd_tolak[$key] = 1;
                $d_tolak = array_sum($bd_tolak);
            }

        }
        $data_2 = array(['value'=> $terims,'name' =>'Berkas Diterima'],
                        ['value'=> $b_tolaks,'name' =>'Berkas Ditolak UPT'],
                        ['value'=> $t_lengkap,'name' =>'Berkas Tidak Lengkap'],
                        ['value'=> $d_tolak,'name' =>'Berkas Ditolak Dinas']);
        // return $data_2;
        return view('upt.dashboard',compact('namabul','val','asus','totalLoket','totalBerkas','totalAntrian','data','data_2'));
    }

    public function dashKec()
    {
        $asu = $asus = [];
        $terims = $b_tolaks = $d_tolak = $t_lengkap = [];
        $months = array();
        for ($i = 0; $i < 13; $i++) {
            $timestamp = mktime(0, 0, 0, date('n') - $i, 1);
            $months[date('n', $timestamp)] = date('F', $timestamp);
        }
        
        $bulan = Antrian::selectRaw('DATE_FORMAT(tanggal_antrian,"%m") as bulan')->where('tanggal_antrian', "like", "%" . date('Y') . "%")->groupBy('bulan')->get()->pluck('bulan');
        $child = auth()->user()->child_id;
        $loket = Loket::where('child_id',$child)->pluck('id','nama_loket');
        $totalLoket = Loket::where('child_id',$child)->count();
        $totalBerkas = UserDocuments::with('antrian.loket')->whereHas('antrian',function($a) use($child){
            $a->whereHas('loket',function($l) use($child){
                $l->where('child_id',$child);
            });
        })->count();
        $totalAntrian = Antrian::whereHas('loket',function($l) use($child){
            $l->where('child_id',$child);
        })->count();
        $totalAntrianLoket = Antrian::selectRaw('loket_id, count(*) as total')->whereIn('loket_id', $loket)->groupBy('loket_id')->get()->pluck('total', 'loket_id');
        $totalAntrianBulanan = Antrian::selectRaw('DATE_FORMAT(tanggal_antrian,"%m") as bulan, count(*) as total')->where('tanggal_antrian', "like", "%" .date('Y') . "%")->whereIn('loket_id',$loket)->groupBy('bulan')->get()->pluck('total','bulan');
        
        foreach($totalAntrianBulanan as $bulans => $total)
        {  
            $hasil[$bulans] = $total;
            
        }
        foreach($months as $id => $bu){
            if (isset($hasil[$id])) {
                $val[] = $hasil[$id];
            }
            else{
                $val[] = 0; 
            }
            $namabul[] = $bu;
        }
        
        foreach($totalAntrianLoket as $id => $total)
        {
            $asu[$id] = $total;
        }
        
        foreach($loket as $nama => $id)
        {   
            if (isset($asu[$id])) {
                $asus[] = array('value' => $asu[$id], 'name' => 'Loket: '.$nama.'');
            }
            else{
                $asus[] = array('value' => 0, 'name' => 'Loket: '.$nama.'');
            }
            
        }
        // return $asus;
        $data = array(['value' => $totalBerkas , 'name'=>'TOTAL BERKAS'],['value' => $totalAntrian , 'name'=>'TOTAL ANTRIAN'],['value' => $totalLoket , 'name'=>'TOTAL LOKET']);
        
        $docu = UserDocuments::with('antrian.loket.district')->whereHas('antrian',function($a) use($child){
            $a->whereHas('loket',function($l) use($child){
                $l->where('child_id',$child);
            });
        })->get();
        foreach($docu as $key => $items)
        {
            if($items->status_berkas == 1)
            {
                $bterima[$key] = 1;
                $terims = array_sum($bterima);
            }
            else if($items->status_berkas == 2)
            {
                $btolak[$key] = 1;
                $b_tolaks = array_sum($btolak);
            }
            else if($items->status_berkas == 3)
            {
                $bt_lengkap[$key] = 1;
                $t_lengkap = array_sum($bt_lengkap);
            }
            else if($items->status_berkas == 4)
            {
                $bd_tolak[$key] = 1;
                $d_tolak = array_sum($bd_tolak);
            }

        }
        $data_2 = array(['value'=> $terims,'name' =>'Berkas Diterima'],
                        ['value'=> $b_tolaks,'name' =>'Berkas Ditolak UPT'],
                        ['value'=> $t_lengkap,'name' =>'Berkas Tidak Lengkap'],
                        ['value'=> $d_tolak,'name' =>'Berkas Ditolak Dinas']);
        // return $data_2;
        return view('upt.dashboard',compact('namabul','val','asus','totalLoket','totalBerkas','totalAntrian','data','data_2'));
    }

}
