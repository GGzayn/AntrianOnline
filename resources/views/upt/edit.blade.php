@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit UPT
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit UPT</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Edit UPT</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @foreach($upt as $row)
                <form action="{{route('admin.upts.update', $row->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                    <div class="form-group">
                        <label for="upt" class="col-sm-2 control-label">UPT</label>

                        <div class="col-sm-10">
                        <input type="text" name="upt" class="form-control" id="upt" value="{{$row->upt}}" placeholder="UPT" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kode_upt" class="col-sm-2 control-label">Kode UPT</label>

                        <div class="col-sm-10">
                        <input type="text" name="kode_upt" class="form-control" id="kode_upt" value="{{$row->kode_upt}}" placeholder="Kode UPT" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                        <textarea required name="alamat" id="alamat" cols="30" rows="10">{{$row->alamat}}</textarea>
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
