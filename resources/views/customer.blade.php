<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/css/customer.css')}}">
    <title>{{ config('app.name', 'Antrian Online') }} </title>
</head>

<body>
    <div class="container head">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <h1 class="display-1"> <b>SELAMAT DATANG</b> </h1>
        <div class="btn-group" role="group" aria-label="Basic example">
            @if(Auth::user()->role_id == 2)
                <a href="{{route('dinas.offlines.create')}}" class="btn btn-success btn-rounded">DAFTAR
                OFFLINE</a>
            @elseif(Auth::user()->role_id == 4)
                <a href="{{route('kecamatan.offlines.create')}}" class="btn btn-success btn-rounded">DAFTAR OFFLINE</a>
            @elseif(Auth::user()->role_id == 8)
                <a href="{{route('adminUpt.offlines.create')}}" class="btn btn-success btn-rounded">DAFTAR OFFLINE</a>
            @endif
        </div>
        <div class="btn-group" role="group" aria-label="Basic example">
            @if(Auth::user()->role_id == 2)
                <a href="{{route('dinas.scan')}}" class="btn btn-danger btn-rounded">SCAN QR CODE</a>
            @elseif(Auth::user()->role_id == 4)
                <a href="{{route('kecamatan.scan')}}" class="btn btn-danger btn-rounded">SCAN QR CODE</a>
            @elseif(Auth::user()->role_id == 8)
                <a href="{{route('adminUpt.scan')}}" class="btn btn-danger btn-rounded">SCAN QR CODE</a>
            @endif
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous">
    </script>

</body>

</html>
