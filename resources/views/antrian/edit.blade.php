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
                        <h3 class="box-title">Form Edit Berkas </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @foreach($userAntrians as $row)
                        @if(Auth::user()->role_id == 7)
                            <form action="{{route('upt.antrians.update', $row->id)}}" method="post" class="form-horizontal">
                        @endif
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <h3 class="box-title"> Nomor Dokumen : {{$row->id}} </h3>
                            <div class="form-group">
                                <label for="rt" class="col-sm-2 control-label">RT</label>
                                <div class="col-sm-10">
                                    <input type="text" name="rt" class="form-control" id="rt" placeholder="RT" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="rw" class="col-sm-2 control-label">RW</label>
                                <div class="col-sm-10">
                                    <input type="text" name="rw" class="form-control" id="rw" placeholder="RW" required>
                                </div>
                            </div>

                            <div class="form-group">
                                    <label for="alamat" class="col-sm-2 control-label">Alamat Rumah</label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" cols="50" name="alamat" class="form-control" id="alamat" placeholder="Alamat Rumah" required></textarea>
                                    </div>
                                </div>

                            @if(Auth::user()->role_id == 7)
                                <div class="form-group">
                                    <label for="kecamatan" class="col-sm-2 control-label">Pilih Kecamatan</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="kecamatan" id="keca" required>
                                        <option hidden>Pilih Kecamatan</option>
                                            @foreach($kecamatan as $row)
                                                <option value="{{$row->id}}" id="kecamatan">{{$row->district}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kelurahan" class="col-sm-2 control-label">Pilih Kelurahan</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="kelurahan" id="kelu" required>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nop" class="col-sm-2 control-label">NOP</label>
                                    <div class="col-sm-10">
                                        <textarea required rows="4" cols="50" name="nop" class="form-control" id="nop" placeholder="NOP (contoh:1111111,111111,111111)"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nama_wp" class="col-sm-2 control-label">Nama Wajib Pajak</label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" required cols="50" name="nama_wp" class="form-control" id="nama_wp" placeholder="Nama Wajib Pajak (contoh:nama wp, nama wp, nama wp)"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_berkas" class="col-sm-2 control-label">Jumlah Berkas</label>
                                    <div class="col-sm-10">
                                        <input type="number" required name="jumlah_berkas" class="form-control" id="jumlah_berkas" placeholder="Jumlah Berkas (isi dengan angka)">
                                    </div>
                                </div>
                            @elseif(Auth::user()->role_id == 5)

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
                    @endforeach
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
                        url: "{{url('getUrban')}}/"+keca,
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
