@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tabel Berkas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Berkas</a></li>
    </ol>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Table Berkas Pengguna </h3>
                    <br>
                    <h3 class="box-title">Total Berkas Baru Hari ini : {{$newBerkas}} </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Status Berkas</th>
                        <th>Catatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        @foreach($row->antrian as $waw)
                            @if($waw->status_antrian == 3)
                            <tr>
                                <td>{{$waw->nama}}</td>
                                <td>{{$waw->nik}}</td>
                                @foreach($waw->userDoc as $usr)
                                    @if($usr->status_berkas == 0)
                                    <td><b style = "color : blue ">Berkas Di Proses</b> </td>
                                    @elseif($usr->status_berkas == 1)
                                    <td> <b style = "color : green "> Berkas Di Terima </b></td>
                                    @elseif($usr->status_berkas == 2)
                                    <td> <b style = "color : red "> Berkas Di Tolak </b></td>
                                    @endif
                                    <td>{{$usr->note}}</td>
                                
                                    <td>
                                    @if(Auth::user()->role_id == 4)
                                        <form action="{{route('kecamatan.documents.edit', $usr->id) }}" method="post" class="form-horizontal">
                                    @elseif(Auth::user()->role_id == 8)
                                        <form action="{{route('adminUpt.documents.edit', $usr->id) }}" method="post" class="form-horizontal">
                                    @endif
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="btn btn-success btn-rounded">Update Status Berkas</button>
                                        </form>
                                    </td>
                                @endforeach
                            </tr>
                            @endif
                        @endforeach
                    
                    @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection
