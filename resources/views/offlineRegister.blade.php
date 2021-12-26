<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="{{url('/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{url('/js/print.js')}}"></script>
    <title>{{ config('app.name', 'Antrian Online') }} | Pendaftaran OFFLINE</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/skins/_all-skins.min.css">
    <script src="{{url('/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{url('/js/print.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
    <section class="content">
        <div class="box">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Register</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @if(Auth::user()->role_id == 2)
                        <form action="{{route('dinas.offlines.store')}}" method="post" class="form-horizontal">
                    @elseif(Auth::user()->role_id == 4)
                        <form action="{{route('kecamatan.offlines.store')}}" method="post" class="form-horizontal">
                    @elseif(Auth::user()->role_id == 8)
                        <form action="{{route('adminUpt.offlines.store')}}" method="post" class="form-horizontal">
                    @endif
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>

                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nik" class="col-sm-2 control-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nik" class="form-control" id="nik" size="16" maxlength="16" minlength="16" placeholder="NIK" required> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="layanan_id" class="col-sm-2 control-label">Pilih Layanan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="layanan_id" required> 
                                        @foreach($layanan as $row)
                                        <option value="{{$row->id}}" id="layanan_id">{{$row->nama_layanan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(Auth::user()->role_id == 4)

                                <div class="form-group">
                                    <label for="kelurahan" class="col-sm-2 control-label">Pilih Kelurahan</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="kelurahan">
                                            @foreach($data as $row)
                                            <option value="{{$row->id}}" id="kelurahan">{{$row->urban}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif 

                            
                            
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right" id="btn">SUBMIT</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{asset('adminlte')}}/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('adminlte')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{asset('adminlte')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- FastClick -->
    <script src="{{asset('adminlte')}}/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte')}}/dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <script src="{{asset('adminlte')}}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <script src="{{asset('adminlte')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{asset('adminlte')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll -->
    <script src="{{asset('adminlte')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS -->
    <script src="{{asset('adminlte')}}/bower_components/chart.js/Chart.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('adminlte')}}/dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte')}}/dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });

    </script>

    <script type = "text/javascript">
        $(document).ready(function(){
            $('#keca').change(function(){
                var keca = $(this).val();
                if(keca) {
                    $.ajax({
                        url: "{{url('adminUpt/getUrban')}}/"+keca,
                        type: "GET",
                        dataType: "json",
                        // data: {id: keca},
                        success:function(data)
                        {
                            if(data){
                                $('#kelu').empty();
                                $('#kelu').append('<option hidden>Pilih Kelurahan</option>'); 
                                $.each(data, function(key, kelu){
                                    $('select[name="kelurahan"]').append('<option value="'+ kelu +'">' + key+ '</option>');
                                });
                            }else{
                                $('#kelu').empty();
                            }
                        }
                    });
                }else{
                    $('#kelu').empty();
                }
            });
        });
        
    </script>

</body>

</html>
