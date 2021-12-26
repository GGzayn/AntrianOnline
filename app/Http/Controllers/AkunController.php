<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Opd;
use App\Models\Role;
use App\Models\Districts;


class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  User::with(['opd','role'])->where('role_id',2)->orWhere('role_id',3)->paginate(5);
        return view ('akun.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        $opd = Opd::all();
        return view('akun.create',compact('role','opd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = new User;

       $data->name = $request->name;
       $data->email = $request->email;
       $data->password = bcrypt($request->password);
       $data->role_id = $request->role;
       $data->child_id = $request->opd;

       $data->save();

       return redirect()->route('admin.akuns.index')->with('status','new Account has Been Created');
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
        $data = User::where('id',$id)->get();
        $role = Role::all();
        $opd = Opd::all();
        return view('akun.edit',compact('data','role','opd'));
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
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role_id = $request->role;
        $data->child_id = $request->opd;

        $data->save();

        return redirect()->route('admin.akuns.index')->with('status',' Account has Been Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('admin.akuns.index')->with('status',' Account has Been Deleted');
    }

    public function pengguna()
    {
        $user = User::with('opd','role','district','urban','upt')->get();
        return Response([
            'status' => 'success',
            'message' => 'data berhasil ditampilkan',
            'data' => $user
        ], 200);
    }

    public function role()
    {
        $role = Role::get();
        return Response([
            'status' => 'success',
            'message' => 'data berhasil ditampilkan',
            'data' => $role
        ], 200);

    }
}
