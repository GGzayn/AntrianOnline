<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="refresh" content="10" >

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon')}}/apple-touch-icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon')}}/favicon-32x32.png">
  	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon')}}/favicon-16x16.png">
  	<link rel="manifest" href="{{asset('favicon')}}/site.webmanifest">
	<link rel="stylesheet" href="{{url('/css/live.css')}}">
	<title>{{ config('app.name', 'Antrian Online') }} | Dashboard</title>
  </head>
  <body>
    <div class="container-fluid">
		<div class="row justify-content-center">
			<img src="{{asset('img')}}/logo-kabtangerang-sesuaiperda.png" alt="Logo Kabupaten Tangerang" width="100px" height="100px">
			<img src="{{asset('img')}}/Smartcity.png" alt="Smart City Logo" width="200px" height="100px">
		</div>
		<div class="row justify-content-center">
			<h1>SELAMAT DATANG</h1>
		</div>
		<div class="row justify-content-center">
			<h1>{{$title1}}</h1>
		</div>
		<div class="row justify-content-center">
			<h1>{{ Auth::user()->name }}</h1>
		</div>
		<div class="row justify-content-center">
			@foreach ($data as $row)
				<div class="col-lg-3 col-xs-6">
					<div class="border border-2">
						<h1>LOKET : {{$row->nama_loket}}</h1>
						@foreach ($row->antrian as $ant)
							@if ($ant->tanggal_antrian == date('Y-m-d') && $ant->status_antrian == 2)
							<h3>NAMA : {{$ant->nama}}</h3>
							<h3>Nomor Antrian : {{$ant->no_antrian}} </h3>
							@endif
						@endforeach
					</div>
				</div>
			@endforeach
		</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>