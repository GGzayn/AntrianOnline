@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        EDIT BERKAS
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">EDIT BERKAS</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form EDIT BERKAS</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @foreach($data as $row)
                <form action="{{route('dinas.documents.update', $row->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="status_berkas" class="col-sm-2 control-label">Status Berkas</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="status_berkas">
                                    <option value = "0">Berkas Di Terima</option>
                                    <option value = "1">Berkas Di Tolak </option>
                                </select>
                            </div>
                        </div>
                      

                         <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Catatan</label>

                            <div class="col-sm-10">
                            <textarea type="text" name="note" id="note" cols="30" rows="10">{{$row->note}}</textarea>
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
