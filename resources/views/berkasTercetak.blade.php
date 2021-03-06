@extends('admin.layout')



@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tabel Berkas Tercetak
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Berkas Tercetak</a></li>
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
                <h3 class="box-title">Table Berkas <strong>Antrian Online</strong>  </h3>
                <br>
                <h3 class="box-title">Total Berkas yang Harus Dikirim Ke Petugas Pengiriman : {{$newBerkasOnline}} </h3>
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
                        <th>Nomor Dokumen</th>
                        <th>Status Berkas</th>
                        <th>Status Pengiriman</th>
                        <th>Tanggal/Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataOnline as $row)
                        <tr>
                            <td>{{ $row->antrian['nama'] }}</td>
                            <td>{{ $row->antrian['nik'] }}</td>
                            <td>{{$row->antrian->loket['layanan_id']}}.{{ $row->antrian['id'] }}</td>
                            @if($row->status_berkas == 1)
                                <td> <b style = "color : green "> Berkas Di Terima </b></td>
                            @endif
                            @if($row->status_pengiriman == 1)
                                <td><b style = "color : green ">Berkas Telah Di Proses </b></td>
                            @endif
                            <td>{{$row->updated_at->format('d-m-Y H:i:s')}}</td>
                            <td>
                                @if(Auth::user()->role_id == 4)
                                <form action="{{route('kecamatan.berkasKelurahan')}}" method="post">
                                @elseif(Auth::user()->role_id == 8)
                                <form action="{{route('adminUpt.berkasKelurahan')}}" method="post">
                                @endif
                                    @csrf
                                    <input type="hidden" value="{{$row->id}}" name="idBerkas">
                                    <button type="submit" name="petugas" class="btn btn-success btn-rounded">Kirim ke Petugas Pengiriman</button>
                                </form>
                            </td>
                        </tr>  
                    
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Table Berkas <strong>Antrian Offline</strong>  </h3>
                <br>
                <h3 class="box-title">Total Berkas yang Harus Diambil Oleh Masyarakat : {{$newBerkasOffline}} </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Nomor Dokumen</th>
                        <th>Status Berkas</th>
                        <th>Status Pengiriman</th>
                        <th>Tanggal/Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataOffline as $row)
                        <tr>
                            <td>{{ $row->antrian['nama'] }}</td>
                            <td>{{ $row->antrian['nik'] }}</td>
                            <td>{{$row->antrian->loket['layanan_id']}}.{{ $row->antrian['id'] }}</td>
                            @if($row->status_berkas == 1)
                                <td> <b style = "color : green "> Berkas Di Terima </b></td>
                            @endif
                            @if($row->status_pengiriman == 1)
                                <td><b style = "color : green ">Berkas Telah Di Proses </b></td>
                            @endif
                            <td>{{$row->updated_at->format('d-m-Y H:i:s')}}</td>
                            <td>
                                @if(Auth::user()->role_id == 4)
                                <form action="{{route('kecamatan.berkasKelurahan')}}" method="post">
                                @elseif(Auth::user()->role_id == 8)
                                <form action="{{route('adminUpt.berkasKelurahan')}}" method="post">
                                @endif
                                    @csrf
                                    <input type="hidden" value="{{$row->id}}" name="idBerkas">
                                    <button type="submit" name="masyarakat" class="btn btn-success btn-rounded">Berkas Telah DiTerima Masyarakat</button>
                                </form>
                            </td>
                        </tr>  
                    
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
</section>

@endsection
