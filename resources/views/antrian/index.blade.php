@extends('admin.layout')


<style> 
    section {
    -webkit-user-select: none; /* Safari */
    -ms-user-select: none; /* IE 10 and IE 11 */
    user-select: none; /* Standard syntax */
    }
</style>
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="box-title">
        Antrian
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Table Antrian</a></li>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
                <h1 class="box-title">
                    Table Antrian per Loket
                </h1>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Nama Loket</th>
                                <th>Antrian Hari Ini</th>
                                <th>Status Loket</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>

                                <td>{{$row->nama_petugas}}</td>
                                <td>{{$row->nama_loket}}</td>
                                <td><b>{{$row->count_of_today}}</b></td>
                                <td>
                                    @if( $row->status_loket == 1 )
                                        <b style = "color : green ">ONLINE</b>
                                    @elseif($row->status_loket == 0 )
                                        <b style = "color : red">OFFLINE</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <form action="{{route('dinas.lokets.edit', $row->id) }}" method="post">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-info btn-rounded">EDIT</button>
                                            </form>
                                            <form action="{{route('dinas.lokets.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                                            </form>

                                        </ul>
                                    </div>
                                    <hr>
                                        @if($row->count_of_today != 0)
                                            <form action="{{route('loket.statusLoket')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$row->id}}" name="idLoket">
                                                <button type="submit" class="btn btn-rounded btn-success">Mulai Antrian</button>
                                            </form>
                                        @endif
                                            <br>
                                            <form action="{{route('loket.hapusLoket')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$row->id}}" name="idLoket">
                                                <button type="submit" class="btn btn-rounded btn-danger">Stop Antrian</button>
                                            </form>
                                        
                                </td>

                            </tr>
                            @endforeach

                            </tfoot>
                    </table>
                    {{ $data->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        @foreach($data2 as $row)
        <div class="col-xs-12">
            <div class="box">
               
                <div class="box-header">
                    <h1 class="box-title">
                        @if($row->loket_antrian == 1)
                        {{$row->layanan->nama_layanan}} / Antrian ONLINE
                        @else
                        {{$row->layanan->nama_layanan}} / Antrian Offline
                        @endif
                    </h1>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <input type="hidden" value="{{$row->nama_loket}}" name="naLok" id="naLok">
                <div class="box-body">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama </th>
                                <th>NIK</th>
                                <th>Nomor Antrian</th>
                                <th>Tanggal Antrian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($row->antrian as $ska)
                                @if($ska->status_antrian == 1 && $ska->tanggal_antrian == date('Y-m-d') )
                                    <tr>
                                        <td>{{$ska->nama }}</td>
                                        <td>{{$ska->nik }}</td>
                                        <td>{{$ska->no_antrian }}</td>
                                        <td>{{$ska->tanggal_antrian }}</td>
                                        <td><b style = "color : red ">Mengantri</b></td>
                                        <td>
                                            <button class=" btn btnSelect"><i class="fa fa-microphone"></i></button>
                                            <form action="{{route('loket.statusAntrian')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$ska->id}}" name="idAntrian">
                                                <button type="submit" class="btn btn-rounded btn-info">Panggil</button>
                                                
                                            </form>
                                            <br>
                                            <form action="#" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$ska->id}}" name="idAntrian">
                                                <button type="submit" class="btn btn-rounded btn-danger">Selesai</button>
                                            </form>
                                            <br>
                                            
                                        </td>
                                        
                                    </tr>

                                @elseif($ska->status_antrian == 2 && $ska->tanggal_antrian == date('Y-m-d') )
                                    <tr>
                                        <td>{{$ska->nama }}</td>
                                        <td>{{$ska->nik }}</td>
                                        <td>{{$ska->no_antrian }}</td>
                                        <td>{{$ska->tanggal_antrian }}</td>
                                        <td><b style = "color : green ">Di Loket</b></td>
                                        <td>
                                            <button class=" btn btnSelect"><i class="fa fa-microphone"></i></button>
                                            <form action="{{route('loket.hapusAntrian')}}" method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" value="{{$ska->id}}" name="idAntrian">
                                                <button type="submit" class="btn btn-rounded btn-danger">Selesai</button>
                                            </form>
                                            <br>
                                        </td>
                                        
                                    </tr>
                                
                                @endif
                            @endforeach

                            </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
                
            </div>
            <!-- /.box -->
        </div>
        @endforeach
        <!-- /.col -->
    </div>
    <!-- /.row -->

   
</section>

@endsection
<script src="{{url('/js/jquery-2.2.4.min.js')}}"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=SmCCuXXD"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // code to read selected table row cell data (values).
        $(".btnSelect").click(function () {
            // get the current row
            var currentRow=$(this).closest("tr"); 
            
            var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
            var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
            var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
            var lok = $("#naLok").val();
            var data=col1+"\n"+col2+"\n"+col3;
            
            // alert(data);

            responsiveVoice.speak(
                "Nomor Antrian '" + col3 + "' Atas Nama '" + col1 + "' Ke Loket '" + lok + "'",
                "Indonesian Male",
                {
                pitch: 1, 
                rate: 0.9, 
                volume: 4
                }
            );
        });
    });
  
 </script>
