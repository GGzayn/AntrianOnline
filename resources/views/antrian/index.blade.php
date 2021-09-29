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
                                    @if($row->count_of_today != 0)
                                        @if(Auth::user()->role_id == 3)
                                        <form action="{{route('loket.statusLoket')}}" method="post" class="form-horizontal">
                                        @elseif(Auth::user()->role_id == 5)
                                        <form action="{{route('loketKecamatan.statusLoket')}}" method="post" class="form-horizontal">
                                        @elseif(Auth::user()->role_id == 7)
                                        <form action="{{route('upt.statusLoket')}}" method="post" class="form-horizontal">
                                        @endif
                                            @csrf
                                            <input type="hidden" value="{{$row->id}}" name="idLoket">
                                            <button type="submit" class="btn btn-rounded btn-success">Mulai Antrian</button>
                                        </form>
                                        <hr>
                                    @endif
                                        <br>
                                        @if(Auth::user()->role_id == 3)
                                        <form action="{{route('loket.hapusLoket')}}" method="post" class="form-horizontal">
                                        @elseif(Auth::user()->role_id == 5)
                                        <form action="{{route('loketKecamatan.hapusLoket')}}" method="post" class="form-horizontal">
                                        @elseif(Auth::user()->role_id == 7)
                                        <form action="{{route('upt.hapusLoket')}}" method="post" class="form-horizontal">
                                        @endif
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
            var col4=currentRow.find("td:eq(4)").text(); // get current row 3rd TD
            // var lok = $("#naLok").val();
            var data=col1+"\n"+col2+"\n"+col3;
            
            // alert(data);

            responsiveVoice.speak(
                "Nomor Antrian '" + col3 + "' Atas Nama '" + col1 + "' Ke Loket '" + col4 + "'",
                "Indonesian Female",
                {
                pitch: 1, 
                rate: 0.9, 
                volume: 4
                }
            );
        });
    });
  
 </script>
