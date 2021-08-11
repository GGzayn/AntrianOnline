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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box" id="info">
          <img src="{{asset('img')}}/logo-kabtangerang-sesuaiperda.png" alt="Logo Kabupaten Tangerang" width="100px" height="100px">
          <img src="{{asset('img')}}/Smartcity.png" alt="Smart City Logo" width="200px" height="100px">
          <h1>SELAMAT DATANG {{ Auth::user()->name }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
