@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Syarat Layanan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Syarat Layanan</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Edit Syarat Layanan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @foreach($syarat as $row)
              <form action="{{route('admin.syarats.update',$row->id)}}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <label for="syarat" class="col-sm-2 control-label">Syarat</label>
                        <div class="col-sm-10">
                            <textarea required  name="syarat" id="alamat" cols="100" rows="10">{{$row->syarat}}</textarea>
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
