@extends('admin.layout')

@section('meta')
<meta http-equiv="refresh" content="30">
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="box-title">
        Tabel Loket
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Loket</a></li>
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
                <div class="box-header with-border">
                    <a href="{{route('dinas.lokets.create')}}" class="btn btn-rounded btn-danger">Tambah Loket</a>
                    <a href="{{route('dinas.liveAntrian')}}" target="_blank" class="btn btn-rounded btn-success">Lihat Semua Antrian</a>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Nama Loket</th>
                                <th>Nama Layanan</th>
                                <th>Waktu Buka / Waktu Tutup</th>
                                <th>Interval Waktu/Booking</th>
                                <th>Antrian Hari Ini</th>
                                <th>Status Loket</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>

                                <td>{{$row->nama_petugas}}</td>
                                <td>{{$row->nama_loket}}</td>
                                <td>{{$row->layanan->nama_layanan}}</td>
                                <td>{{$row->waktu_buka_name}} - {{$row->waktu_tutup_name}}</td>
                                <td>{{$row->interval_waktu}} / {{$row->interval_booking}} Menit</td>
                                <td><b>{{$row->count_of_today}}</b></td>
                                <td>
                                    @if( $row->status_loket == 1 )
                                        <b style = "color : green ">ONLINE</b>
                                    @elseif($row->status_loket == 0 )
                                        <b style = "color : red">OFFLINE</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">VIEW</a></li>
                                            <li><a href="#">EDIT</a></li>
                                            <li><a href="#">DELETE</a></li>

                                        </ul>
                                    </div>
                                        @if($row->count_of_today != 0)
                                            <form action="{{route('loket.statusLoket')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$row->id}}" name="idLoket">
                                                <button type="submit" class="btn btn-rounded btn-success">Mulai Antrian</button>
                                            </form>
                                        @endif
                                            <br>
                                            <form action="{{route('loket.hapusLoket')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$row->id}}" name="idLoket">
                                                <button type="submit" class="btn btn-rounded btn-danger">Stop Antrian</button>
                                            </form>
                                        
                                </td>

                            </tr>
                            @endforeach

                            </tfoot>
                    </table>
                    {{ $data->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        @foreach($data2 as $row)
        <div class="col-xs-12">
            <div class="box">
               
                <div class="box-header">
                    <h1 class="box-title">
                        {{$row->nama_loket}}
                    </h1>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama </th>
                                <th>NIK</th>
                                <th>Nomor Antrian</th>
                                <th>Tanggal Antrian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($row->antrian as $ska)
                                @if($ska->status_antrian == 1 && $ska->tanggal_antrian == date('Y-m-d') )
                                    <tr>
                                        <td>{{$ska->nama }}</td>
                                        <td>{{$ska->nik }}</td>
                                        <td>{{$ska->no_antrian }}</td>
                                        <td>{{$ska->tanggal_antrian }}</td>
                                        <td><b style = "color : red ">Mengantri</b></td>
                                        <td>
                                            <form action="{{route('loket.statusAntrian')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$ska->id}}" name="idAntrian">
                                                <button type="submit" class="btn btn-rounded btn-info">Panggil</button>
                                            </form>
                                            <br>
                                            <form action="#" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$ska->id}}" name="idAntrian">
                                                <button type="submit" class="btn btn-rounded btn-danger">Selesai</button>
                                            </form>
                                            <br>
                                            
                                        </td>
                                        
                                    </tr>

                                @elseif($ska->status_antrian == 2 && $ska->tanggal_antrian == date('Y-m-d') )
                                    <tr>
                                        <td>{{$ska->nama }}</td>
                                        <td>{{$ska->nik }}</td>
                                        <td>{{$ska->no_antrian }}</td>
                                        <td>{{$ska->tanggal_antrian }}</td>
                                        <td><b style = "color : green ">Di Loket</b></td>
                                        <td>
                                            <form action="{{route('loket.hapusAntrian')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$ska->id}}" name="idAntrian">
                                                <button type="submit" class="btn btn-rounded btn-danger">Selesai</button>
                                            </form>
                                            <br>
                                            
                                        </td>
                                        
                                    </tr>
                                
                                @endif
                            @endforeach

                            </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
                
            </div>
            <!-- /.box -->
        </div>
        @endforeach
        <!-- /.col -->
    </div>
    <!-- /.row -->

   
</section>

@endsection
