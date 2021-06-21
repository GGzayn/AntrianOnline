@extends('admin.layout')

@section('content')



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

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
      @foreach($antrian as $row)
        <div class="col-md-3 col-sm-6 col-xs-12">
          
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion-ios-paper-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{$row->loket->layanan['nama_layanan']}}</span>
              <span class="info-box-text">LOKET : {{$row->loket->nama_loket}}</span>
              <span class="info-box-number">TOTAL ANTRIAN : {{$row->total}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          
        </div>
        <!-- /.col -->
        @endforeach
      </div>
    <!-- /.row -->


    
</section>
<!-- /.content -->

@endsection
