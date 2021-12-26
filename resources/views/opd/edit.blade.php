@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Edit OPD
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit OPD</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Edit OPD</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @foreach($opd as $row)
                <form action="{{route('admin.opds.update',$row->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                    <div class="form-group">
                        <label for="kodeOpd" class="col-sm-2 control-label">Kode OPD</label>

                        <div class="col-sm-10">
                        <input type="number" name="id_opd" class="form-control" id="id_opd" value="{{$row->id_opd}}" placeholder="Kode OPD" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="namaOpd" class="col-sm-2 control-label">Nama OPD</label>

                        <div class="col-sm-10">
                        <input type="text" name="nama_opd" class="form-control" id="namaOpd" value="{{$row->nama_opd}}" placeholder="Nama OPD" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_kordinator" class="col-sm-2 control-label">Nama Kordinator</label>

                        <div class="col-sm-10">
                        <input type="text" name="nama_kordinator" class="form-control" id="nama_kordinator" value="{{$row->nama_kordinator}}" placeholder="Nama Kordinator" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip_kordinator" class="col-sm-2 control-label">NIP Kordinator</label>

                        <div class="col-sm-10">
                        <input type="number" name="nip_kordinator" class="form-control" id="nip_kordinator" value="{{$row->nip_kordinator}}" placeholder="NIP Kordinator" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>

                        <div class="col-sm-10">
                        <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{$row->jabatan}}" placeholder="Jabatan" required>
                        </div>
                    </div>
                    
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">SUBMIT</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
              @endforeach
          </div>
        </div>
      </div>
    </section>

@endsection
