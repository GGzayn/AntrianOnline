@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tabel Berkas
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Berkas</a></li>
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
                <h3 class="box-title">Table Report Berkas </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('laporanBerkas')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Date range:</label>

                        <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                            <input type="text" class="form-control" id="reservation" name="reservation">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <button type="submit" class="btn btn-success btn-rounded">SUBMIT</button>
                </form>
                <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                       <th>Nama</th>
                       <th>NIK</th>
                       <th>Nomor Dokumen</th>
                       <th>Nama Layanan</th>
                       <th>Tanggal/Waktu</th>
                       <th>Status Berkas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doc as $row)
                        <tr>
                            <td>{{$row->antrian['nama']}}</td>
                            <td>{{$row->antrian['nik']}}</td>
                            <td>{{$row->antrian->loket['layanan_id']}}.{{$row->antrian['id']}}</td>
                            <td>{{$row->antrian->loket->layanan['nama_layanan']}}</td>
                            <td>{{$row->updated_at->format('d-m-Y H:i:s')}}</td>
                            @if($row->status_berkas == 0)
                                <td> <b style = "color : blue "> Proses Verifikasi Berkas </b></td>
                            @elseif($row->status_berkas == 2)
                                <td> <b style = "color : red "> Berkas DiTolak Oleh UPT </b></td>
                            @elseif($row->status_berkas == 3)
                                <td> <b style = "color : red "> Berkas Tidak Lengkap </b></td>
                            @elseif($row->status_berkas == 4)
                                <td> <b style = "color : red "> Berkas Ditolak Oleh Dinas </b></td>
                            @else
                                @if($row->status_pengiriman == 0)
                                    <td> <b style = "color : green "> Berkas Dikirim ke Dinas </b></td>
                                @elseif($row->status_pengiriman == 1)
                                    <td> <b style = "color : green "> Berkas Telah Diproses Oleh Dinas </b></td>
                                @elseif($row->status_pengiriman == 2)
                                    <td> <b style = "color : green "> Berkas Dikirim Ke Petugas Pengiriman </b></td>
                                @elseif($row->status_pengiriman == 3)
                                    <td> <b style = "color : green "> Berkas Di Pickup Oleh Kurir Tancap Gas </b></td>
                                @elseif($row->status_pengiriman == 4)
                                    <td> <b style = "color : green "> Berkas Di Antar Oleh Kurir Tancap Gas </b></td>
                                @elseif($row->status_pengiriman == 5)
                                    <td> <b style = "color : green "> Berkas Berhasil Terkirim ke Masyarakat</b></td>
                                @elseif($row->status_pengiriman == 6)
                                    <td> <b style = "color : red "> Berkas Gagal Terkirim </b></td>
                                @elseif($row->status_pengiriman == 7)
                                    <td> <b style = "color : green "> Kurir Ditugaskan </b></td>
                                @elseif($row->status_pengiriman == 8)
                                    <td> <b style = "color : green "> Berkas Diterima Oleh Dinas </b></td>
                                @endif
                            @endif
                        </tr>
                        
                    @endforeach
                </tbody>
                
              </table>
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
