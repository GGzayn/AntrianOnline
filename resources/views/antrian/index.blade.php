@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Antrian
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Antrian</a></li>
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
                <h1>
                    Total Antrian Loket
                </h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Loket</th>
                                <th>Total Antrian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTotalAntrianLoket as $row)
                            <tr>
                                <td>{{$row->nama_loket}}</td>
                                <td>{{$row->antrian->count()}}</td>
                            </tr>
                            @endforeach

                            </tfoot>
                    </table>
                    {{ $dataTotalAntrianLoket->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1>
                        Table Antrian Hari ini
                    </h1>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama </th>
                                <th>NIK</th>
                                <th>Waktu</th>
                                <th>Loket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAntrian as $row)
                            <tr>
                                <td>{{$row->nama}}</td>
                                <td>{{$row->nik}}</td>
                                <td>{{$row->waktu_antrian}}</td>
                                <td>{{$row->loket->nama_loket}}</td>
                            </tr>
                            @endforeach

                            </tfoot>
                    </table>
                    {{ $dataAntrian->links() }}
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
