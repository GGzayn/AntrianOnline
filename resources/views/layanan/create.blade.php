@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create Layanan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Layanan</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Create Layanan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="{{route('dinas.layanans.store')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="nama_layanan" class="col-sm-2 control-label">Nama Layanan</label>

                    <div class="col-sm-10">
                      <input type="text" name="nama_layanan" class="form-control" id="nama_layanan" placeholder="Nama Layanan">
                    </div>

                    <div class="col-sm-10">
                      <input type="hidden" name="opd_id" class="form-control" id="opd_id">
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">SUBMIT</button>
                </div>
                <!-- /.box-footer -->
              </form>
          </div>
        </div>
      </div>
    </section>

@endsection
