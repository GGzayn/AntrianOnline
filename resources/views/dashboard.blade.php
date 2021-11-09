@extends('admin.layout')

@section('content')

<style>
  .row{
    text-align:center;
    font-family : roboto;
    
  }
  #info{
    padding:10px;
  }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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

<section class="content">
  
@if(Auth::user()->role_id == 2)
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

          <div class="box-header with-border">
            <h3 class="box-title"> Loket</h3>
          </div>

          <div class="box-body">
            @foreach($loket as $row)
              <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green" style="text-align:left;">
                  <div class="inner">
                    <h4>Layanan : {{$row->layanan->nama_layanan}}</h4>
                    <p>Loket : {{$row->nama_loket}}</p>
                    <p>Petugas : {{$row->nama_petugas}}</p>
                    <p>Total Antrian : {{$row->antrian->count_of_today}}</p>
                    
                  </div>
                  <div class="icon">
                    <i class="ion-podium"></i>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title"> Berkas</h3>
            </div>

            <div class="box-body">
                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Proses Oleh Dinas</h4>
                            <h5 class="box-title">{{$prosesDinas}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-purple" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Cetak Oleh Dinas</h4>
                            <h5 class="box-title">{{$berkasCetak}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

            </div>

        </div>
      </div>
    </div>
  </div>

@elseif(Auth::user()->role_id == 4 || Auth::user()->role_id == 8)

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

          <div class="box-header with-border">
            <h3 class="box-title"> Loket</h3>
          </div>

          <div class="box-body">
            @foreach($loket as $row)
              <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green" style="text-align:left;">
                  <div class="inner">
                    <h4>Layanan : {{$row->layanan->nama_layanan}}</h4>
                    <p>Loket : {{$row->nama_loket}}</p>
                    <p>Petugas : {{$row->nama_petugas}}</p>
                    <p>Total Antrian : {{$row->antrian->count()}}</p>
                    
                  </div>
                  <div class="icon">
                    <i class="ion-podium"></i>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title"> Proses Berkas</h3>
            </div>

            <div class="box-body">
                <div class="col-lg-4">
                    <!-- small box -->
                    <div class="small-box bg-blue" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Proses</h4>
                            <h5 class="box-title">{{$berkasProses}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- small box -->
                    <div class="small-box bg-green" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Terima</h4>
                            <h5 class="box-title">{{$berkasTerima}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- small box -->
                    <div class="small-box bg-red" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Tolak</h4>
                            <h5 class="box-title">{{$berkasTolak}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                

            </div>

        </div>
      </div>
    </div>
  </div>



  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Pengiriman Berkas</h3>
            </div>

            <div class="box-body">

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Proses Oleh Dinas</h4>
                            <h5 class="box-title">{{$prosesDinas}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-purple" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Cetak Oleh Dinas</h4>
                            <h5 class="box-title">{{$berkasCetak}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-navy" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Kirim ke Kelurahan</h4>
                            <h5 class="box-title">{{$berkasKelurahan}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Pickup oleh Kurir</h4>
                            <h5 class="box-title">{{$pickup}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-orange" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Di Antar oleh Kurir</h4>
                            <h5 class="box-title">{{$antar}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-green" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Terkirim</h4>
                            <h5 class="box-title">{{$terkirim}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-red" style="text-align:left;">
                        <div class="inner">
                            <h4 class="box-title">Berkas Gagal Terkirim</h4>
                            <h5 class="box-title">{{$gagal}}</h5>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-paper"></i>
                        </div>
                    </div>
                </div>

            </div>

        </div>
      </div>
    </div>
  </div>
  
</section>
@endif

@endsection
