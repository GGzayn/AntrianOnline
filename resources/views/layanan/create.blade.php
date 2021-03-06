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
                      <input type="text" name="nama_layanan" class="form-control" id="nama_layanan" placeholder="Nama Layanan" required>
                    </div>

                    <div class="col-sm-10">
                      <input type="hidden" name="opd_id" class="form-control" id="opd_id">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kode_layanan" class="col-sm-2 control-label">Kode Layanan</label>

                    <div class="col-sm-10">
                      <input type="text" name="kode_layanan" class="form-control" id="kode_layanan" placeholder="Kode Layanan" required>
                    </div>
                    
                  </div>

                  <div class="form-group">
                    <label for="kata_kunci" class="col-sm-2 control-label">Kata Kunci</label>

                    <div class="col-sm-10">
                      <input required type="text" name="kata_kunci" class="form-control" id="kata_kunci" placeholder="Masukkan Maksimal 3 Karakter Menggunakan Huruf Kapital">
                    </div>
                    
                  </div>

                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Alamat</label>

                    <div class="col-sm-10">
                      <textarea required  name="alamat" id="alamat" cols="70" rows="10"></textarea>
                    </div>
                    
                  </div>

                  <div class="form-group">
                    <label for="no_telepon" class="col-sm-2 control-label">Nomor Telepon</label>

                    <div class="col-sm-10">
                      <input type="text" name="no_telepon" class="form-control" id="no_telepon" placeholder="Nomor Telepon (021123456789)" required>
                    </div>
                    
                  </div>

                  <div class="form-group">
                      <label for="jenis_layanan" class="col-sm-2 control-label">Jenis Layanan</label>

                      <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%;" name="jenis_layanan" required>
                            <option value = "1">Antrian Online</option>
                            <option value = "2">Full Online</option>
                          </select>
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
