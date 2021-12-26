@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tabel Syarat Layanan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Syarat Layanan</a></li>
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
                    <a href="{{route('admin.syarats.create')}}" class="btn btn-rounded btn-danger">Tambah Syarat Layanan</a>
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
                                <th>Nama Layanan</th>
                                <th>Syarat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($syarat as $row)
                            <tr>

                                <td>{{$row->layanan->nama_layanan}}</td>
                                <td>{{$row->syarat}}</td>
                                <td>
                                    <form action="{{route('admin.syarats.edit', $row->id) }}" method="post">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-info btn-rounded">EDIT</button>
                                    </form>
                                    <hr>
                                    <form action="{{route('admin.syarats.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach

                            </tfoot>
                    </table>
                    {{ $syarat->links() }}
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
