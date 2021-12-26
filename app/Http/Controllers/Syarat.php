<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SyaratLayanan;
use App\Models\Layanan;

class Syarat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syarat = SyaratLayanan::with('layanan')->paginate(1);
        return view('syarat.index',compact('syarat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layanan = Layanan::all();
        return view ('syarat.create',compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new SyaratLayanan;

        $data->layanan_id = $request->layanan_id;
        $data->syarat = $request->syarat;
        $data->save();

        return redirect()->route('admin.syarats.index')->with('status',' Syarat Baru Telah Ditambahkan');
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
        $syarat = SyaratLayanan::where('id',$id)->get();
        $layanan = Layanan::all();
        return view ('syarat.edit',compact('syarat','layanan'));
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
        $data = SyaratLayanan::find($id);
        $data->syarat = $request->syarat;
        $data->save();

        return redirect()->route('admin.syarats.index')->with('status',' Syarat Baru Telah Di Perbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SyaratLayanan::find($id);
        $data->delete();
        return redirect()->route('admin.syarats.index')->with('status',' Syarat Baru Telah Di Hapus');
    }

    public function mobileSyarat($id)
    {
        $data = SyaratLayanan::where('layanan_id',$id)->first();
        return Response([
            'status' => 'success',
            'message' => 'Pengambilan data berhasil',
            'data' => $data
        ], 200);

    }
}
