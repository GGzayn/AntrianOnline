@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create Loket 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Loket </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Create Loket</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="{{route('dinas.lokets.store')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="nama_petugas" class="col-sm-2 control-label">Nama Petugas</label>

                        <div class="col-sm-10">
                            <input type="text" name="nama_petugas" class="form-control" id="nama_petugas" placeholder="Nama Petugas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_loket" class="col-sm-2 control-label">Nama Loket</label>

                        <div class="col-sm-10">
                            <input type="text" name="nama_loket" class="form-control" id="nama_loket" placeholder="Nama Loket">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_layanan" class="col-sm-2 control-label">Nama Layanan</label>

                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="nama_layanan">
                                @foreach($layanan as $row)
                                    <option value = "{{$row->id}}"  id="role">{{$row->nama_layanan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_buka" class="col-sm-2 control-label">Waktu Buka</label>

                        <div class="col-sm-10">
                            <input type="text" name="waktu_buka" class="form-control" id="waktu_buka" placeholder="Waktu Buka">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_tutup" class="col-sm-2 control-label">Waktu Tutup</label>

                        <div class="col-sm-10">
                            <input type="text" name="waktu_tutup" class="form-control" id="waktu_tutup" placeholder="Waktu Tutup">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="interval_waktu" class="col-sm-2 control-label">Interval Waktu</label>

                        <div class="col-sm-10">
                            <input type="number" name="interval_waktu" class="form-control" id="interval_waktu" placeholder="Interval Waktu Dalam menit">
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="interval_booking" class="col-sm-2 control-label">Interval Booking</label>

                        <div class="col-sm-10">
                            <input type="number" name="interval_booking" class="form-control" id="interval_booking" placeholder="Interval Booking Dalam menit">
                        </div>
                    </div> -->

                    

                    
                  
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