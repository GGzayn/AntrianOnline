<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{url('/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{url('/js/instascan.min.js')}}"></script>
    <script src="{{url('/js/print.js')}}"></script>
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/qr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('sign')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset('sign')}}/css/main.css">

    <title>{{ config('app.name', 'Antrian Online') }} | Scan Code</title>
</head>

<body>
    <div class="container-login100" style="background-image: url('{{asset('sign')}}/images/bg-02.jpg')">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap-login100">
                    <span class="">
						<img src="{{asset('img')}}/logo-kabtangerang-sesuaiperda.png" alt="Logo Kabupaten Tangerang" width="100px" height="100px">
						<img src="{{asset('img')}}/Smartcity.png" alt="Smart City Logo" width="200px" height="100px">
					</span>
                    <span class="login100-form-title p-b-15 p-t-27">    
                        SCAN YOUR QR CODE HERE
					</span>
                    <video id="preview" height="250" weight="250"></video>
                    <input type="hidden" id="qrCode" name="qrCode" class="form-control">
                </div>
                <!-- <div class="card-header bg-transparent mb-0">
                    <h1 class="text-center" id="judul">SCAN YOUR QR CODE HERE</h1>
                    <div class="card-body">
                        <video id="preview" height="300" weight="300"></video>
                        <input type="hidden" id="qrCode" name="qrCode" class="form-control">
                    </div>
                </div> -->
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
