<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{url('/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{url('/js/print.js')}}"></script>
    <link rel="stylesheet" href="{{url('/css/noAntrian.css')}}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>{{ config('app.name', 'Antrian Online') }} | Cetak Nomor</title>
</head>

<body>  
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($antrix as $row)
                <div class="judul">
                    <p class="title">{{$row->nama}}</p>
                </div>
                <div class="border">
                    <p class="nomor">{{$row->no_antrian}}</p>
                    @foreach($loks as $lok)
                        <p class="loket">Loket : {{$lok->nama_loket}}</p>
                    @endforeach
                </div>
                @foreach($layanan as $lay)
                <h2>Layanan {{$lay->nama_layanan}} </h2>
                @endforeach
                @foreach($opd as $opds)
                <h2>{{$opds->nama_opd}} </h2>
                @endforeach
                <br>
                <p class="tanggal">Hari/Tanggal :{{ $row->updated_at->format('l') }}/ {{ $row->updated_at->format('j F Y') }}</p>
                @endforeach
                <h2>Untuk mendapatkan kemudahan layanan,<br>gunakan aplikasi Tangerang Gemilang</h2>
                <br>
                <h1>Terimakasih Atas Kunjungan Anda</h1>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

</body>
<script type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        document.location.href = "{{route('dinas.offlines.index')}}";
    };
</script>



</html>
