@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create Syarat Layanan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Syarat Layanan</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Create Syarat Layanan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="{{route('admin.syarats.store')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">

                  <div class="form-group">
                    <label for="layanan_id" class="col-sm-2 control-label">Nama Layanan</label>

                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="layanan_id" required>
                            @foreach($layanan as $row)
                                <option value = "{{$row->id}}" id="opd">{{$row->nama_layanan}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="syarat" class="col-sm-2 control-label">Syarat</label>

                    <div class="col-sm-10">
                        <textarea required  name="syarat" id="alamat" cols="70" rows="10"></textarea>
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
