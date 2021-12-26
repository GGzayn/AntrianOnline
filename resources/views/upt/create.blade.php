@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create UPT
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create UPT</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Create UPT</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="{{route('admin.upts.store')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">

                  <div class="form-group">
                    <label for="upt" class="col-sm-2 control-label">UPT</label>

                    <div class="col-sm-10">
                      <input type="text" name="upt" class="form-control" id="upt" placeholder="UPT" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kode_upt" class="col-sm-2 control-label">Kode UPT</label>

                    <div class="col-sm-10">
                      <input type="text" name="kode_upt" class="form-control" id="kode_upt" placeholder="Kode UPT" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Alamat</label>

                    <div class="col-sm-10">
                      <textarea required name="alamat" id="alamat" cols="30" rows="10"></textarea>
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
