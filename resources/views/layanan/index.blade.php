@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tabel Layanan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Layanan</a></li>
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
                    <a href="{{route('dinas.layanans.create')}}" class="btn btn-rounded btn-danger">Tambah Layanan</a>
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
                                <th>Nama Layanan</th>
                                <th>Nama Dinas</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>

                                <td>{{$row->nama_layanan}}</td>
                                <td>{{ $row->opd->nama_opd }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <form action="{{route('dinas.layanans.edit', $row->id) }}" method="post">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-info btn-rounded">EDIT</button>
                                            </form>
                                            <form action="{{route('dinas.layanans.destroy', $row->id) }}" method="post">
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
