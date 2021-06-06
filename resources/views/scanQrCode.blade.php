<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{url('/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{url('/js/instascan.min.js')}}"></script>
    <script src="{{url('/js/print.js')}}"></script>
    <link rel="stylesheet" href="{{url('/css/qr.css')}}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>{{ config('app.name', 'Antrian Online') }} | Scan Code</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-header bg-transparent mb-0">
                    <h1 class="text-center">SCAN YOUR QR CODE HERE</h1>
                    <div class="card-body">
                        <video id="preview" height="300" weight="300"></video>
                        <input type="hidden" id="qrCode" name="qrCode" class="form-control">
                        <!-- <a href="#" class="btn btn-success btn-rounded butt">CETAK NOMOR</a> -->
                    </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

</body>

<script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    scanner.addListener('scan', function (content) {
        window.location.href="{{url('mobilePrint?qrCode=')}}" + content;
        
        
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No Cameras Found');
        }
    }).catch(function (e) {
        console.error(e);
    });

</script>
<!-- <script type="text/javascript">
    $(document).ready(function () {
        $("a.butt").click(function () {
            var qrCode = $("#qrCode").val();
            alert(qrCode);
            $("a.butt").attr("href", "{{url('mobilePrint?qrCode=')}}" + qrCode);
            $.ajax({
                url: "{{route('mobilePrint')}}",
                type: "get",
                data: {"qrCode": qrCode},
            });
        });
        $("a.butt").printPage();
    });

</script> -->

</html>
