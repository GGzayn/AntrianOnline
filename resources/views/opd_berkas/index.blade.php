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
                <h3 class="box-title">Table Berkas Pengguna </h3>
                <br>
                <h3 class="box-title">Jumlah Berkas yang Harus di Proses : {{$newBerkas}} </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Nomor Dokumen</th>
                        <th>Status Berkas</th>
                        <th>Status Pengiriman</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    @if($row->antrian->loket->layanan['opd_id'] ==  Auth::user()->child_id)
                    <tr>
                        <td>{{$row->antrian['nama']}}</td>
                        <td>{{$row->antrian['nik']}}</td>
                        <td>{{$row->antrian->loket['layanan_id']}}.{{$row->antrian['id']}}</td>
                        <td> <b style = "color : green "> Berkas Di Terima </b></td>
                        @if($row->status_pengiriman == 0)
                        <td><b style = "color : blue ">Berkas Dikirim ke Dinas</b></td>
                        @elseif($row->status_pengiriman == 8)
                        <td><b style = "color : green ">Berkas Diterima Oleh Dinas </b></td>
                        @endif
                        <td>{{$row->updated_at->format('d-m-Y H:i:s')}}</td>
                        <td>
                            <form action="{{route('dinas.berkasKirim') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{$row->id}}" name="idBerkas">
                                <button type="submit" name="terima" class="btn btn-success btn-rounded">Proses Berkas</button>
                                <a href="#" data-toggle="modal" data-target="#modal-info{{$row->id}}" class="btn btn-danger btn-rounded">Tolak Berkas</a>

                                <div class="modal modal-danger fade" id="modal-info{{$row->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4>Catatan Penolakan</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:left">
                                                <h4>Reference Number : {{$row->antrian_id}}</h4>
                                                <!-- <input type="hidden" value="{{$row->id}}" name="idBerkas"> -->
                                                <textarea style="color:black;" name="note" id="note" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="tolak" class="btn  btn-outline pull-left">Tolak Berkas</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endif
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
