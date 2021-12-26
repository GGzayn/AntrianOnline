@extends('admin.layout')



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
                    @if(Auth::user()->role_id == 2)
                    <a href="{{route('dinas.lokets.create')}}" class="btn btn-rounded btn-danger">Tambah Loket</a>
                    <a href="{{route('dinas.liveAntrian')}}" target="_blank" class="btn btn-rounded btn-success">Lihat Semua Antrian</a>
                    <!-- <a href="{{route('dinas.export')}}" class="btn btn-rounded btn-primary">Report/Hari</a>
                    <a href="{{route('dinas.exportMonth')}}" class="btn btn-rounded btn-primary">Report/Bulan</a> -->
                    @elseif(Auth::user()->role_id == 4)
                    <a href="{{route('kecamatan.lokets.create')}}" class="btn btn-rounded btn-danger">Tambah Loket</a>
                    <a href="{{route('kecamatan.liveAntrian')}}" target="_blank" class="btn btn-rounded btn-success">Lihat Semua Antrian</a>
                    @elseif(Auth::user()->role_id == 8)
                    <a href="{{route('adminUpt.lokets.create')}}" class="btn btn-rounded btn-danger">Tambah Loket</a>
                    <a href="{{route('adminUpt.liveAntrian')}}" target="_blank" class="btn btn-rounded btn-success">Lihat Semua Antrian</a>
                    @endif
                    
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
                                <th>Loket Antrian</th>
                                <th>Antrian Hari Ini</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>

                                <td>{{$row->nama_petugas}}</td>
                                <td>{{$row->nama_loket}}</td>
                                <td>{{$row->layanan->nama_layanan}}</td>
                                <td>
                                    @if($row->loket_antrian == 1)
                                    Antrian Online
                                    @else
                                    Antrian Offline
                                    @endif
                                </td>
                                <td><b>{{$row->count_of_today}}</b></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        
                                        <ul class="dropdown-menu" role="menu">
                                            @if(Auth::user()->role_id == 2)
                                            <form action="{{route('dinas.lokets.edit', $row->id) }}" method="post">
                                            @elseif(Auth::user()->role_id == 4)
                                            <form action="{{route('kecamatan.lokets.edit', $row->id) }}" method="post">
                                            @elseif(Auth::user()->role_id == 8)
                                            <form action="{{route('adminUpt.lokets.edit', $row->id) }}" method="post">
                                            @endif
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-info btn-rounded">EDIT</button>
                                            </form>
                                            <hr>
                                            @if(Auth::user()->role_id == 2)
                                            <form action="{{route('dinas.lokets.destroy', $row->id) }}" method="post">
                                            @elseif(Auth::user()->role_id == 4)
                                            <form action="{{route('kecamatan.lokets.destroy', $row->id) }}" method="post">
                                            @elseif(Auth::user()->role_id == 8)
                                            <form action="{{route('adminUpt.lokets.destroy', $row->id) }}" method="post">
                                            @endif
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                                            </form>

                                        </ul>
                                    </div>
                                       
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

  

   
</section>

@endsection
