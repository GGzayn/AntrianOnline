@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tabel OPD
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table OPD</a></li>
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
                    <a href="{{route('admin.opds.create')}}" class="btn btn-rounded btn-danger">Tambah OPD</a>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode OPD</th>
                                <th>Nama OPD</th>
                                <th>Nama Kordinator</th>
                                <th>NIP Kordinator</th>
                                <th>Jabatan</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>

                                <td>{{$row->id_opd}}</td>
                                <td>{{$row->nama_opd}}</td>
                                <td>{{$row->nama_kordinator}}</td>
                                <td>{{$row->nip_kordinator}}</td>
                                <td>{{$row->jabatan}}</td>
                                <td>
                                    <form action="{{route('admin.opds.edit', $row->id) }}" method="post">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-info btn-rounded">EDIT</button>
                                    </form>
                                    <hr>
                                    <form action="{{route('admin.opds.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
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
</section>

@endsection
