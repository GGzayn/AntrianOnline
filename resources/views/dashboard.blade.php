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
@foreach($doc2 as $id => $row)
<div class="modal fade" id="modal_{{$id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{$row[0]->antrian->loket->upt->upt}}</h4>
      </div>
      <div class="modal-body">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <th>Total Berkas</th>
              <th>{{$row->count()}}</th>
            </tr>
            <tr>
              <th>Berkas Di Verifikasi</th>
              <th>{{$row->where('status_berkas',0)->count()}}</th>
            </tr>
            <tr>
              <th>Berkas Tidak Lengkap</th>
              <th>{{$row->where('status_berkas',3)->count()}}</th>
            </tr>
            <tr>
              <th>Berkas Di Terima UPT</th>
              <th>{{$row->where('status_berkas',1)->count()}}</th>
            </tr>
            <tr>
              <th>Berkas Di Tolak UPT</th>
              <th>{{$row->where('status_berkas',2)->count()}}</th>
            </tr>
            <tr>
              <th>Berkas Di Tolak Dinas</th>
              <th>{{$row->where('status_berkas',4)->count()}}</th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endforeach
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

          <div class="box-header with-border">
            <h1 > Dashboard {{ Auth::user()->name }}</h1>
          </div>
          <div class="box-body">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-xs-4">
                <div class="small-box bg-yellow" style="text-align:left;">
                  <div class="inner">
                    <h4>{{$upt[0]}}</h4>
                    <h4> <b>Total Antrian = {{$totalAntrian1}}</b> </h4>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal_10001" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-4 col-xs-4">
                <div class="small-box bg-blue" style="text-align:left;">
                  <div class="inner">
                    <h4>{{$upt[1]}}</h4>
                    <h4> <b>Total Antrian = {{$totalAntrian2}}</b> </h4>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal_10002" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-4 col-xs-4">
                <div class="small-box bg-red" style="text-align:left;">
                  <div class="inner">
                    <h4>{{$upt[2]}}</h4>
                    <h4> <b>Total Antrian = {{$totalAntrian3}}</b> </h4>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal_10003" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-green" style="text-align:left;">
                  <div class="inner">
                    <h4>{{$upt[3]}}</h4>
                    <h4> <b>Total Antrian = {{$totalAntrian4}}</b> </h4>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal_10004" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-aqua" style="text-align:left;">
                  <div class="inner">
                    <h4>{{$upt[4]}}</h4>
                    <h4> <b>Total Antrian = {{$totalAntrian5}}</b> </h4>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal_10005" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-xs-6">
        <div class="small-box bg-purple" style="text-align:left;">
          <div class="inner">
            <h4>Total Pelayanan di BAPENDA  </h4>
            <h4>{{$layanan}}</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-xs-6">
        <div class="small-box bg-purple" style="text-align:left;">
          <div class="inner">
            <h4>Total Loket yang Melayani Pelayanan BAPENDA  </h4>
            <h4>{{$loks}}</h4>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Berkas</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div id="container" style="height: 500px"></div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
  
</section>
@endsection

@section('footscript')

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
<script type="text/javascript">
var dom = document.getElementById("container");
var myChart = echarts.init(dom);
var app = {};

var option;

const posList = [
  'left',
  'right',
  'top',
  'bottom',
  'inside',
  'insideTop',
  'insideLeft',
  'insideRight',
  'insideBottom',
  'insideTopLeft',
  'insideTopRight',
  'insideBottomLeft',
  'insideBottomRight'
];
app.configParameters = {
  rotate: {
    min: -90,
    max: 90
  },
  align: {
    options: {
      left: 'left',
      center: 'center',
      right: 'right'
    }
  },
  verticalAlign: {
    options: {
      top: 'top',
      middle: 'middle',
      bottom: 'bottom'
    }
  },
  position: {
    options: posList.reduce(function (map, pos) {
      map[pos] = pos;
      return map;
    }, {})
  },
  distance: {
    min: 0,
    max: 100
  }
};
app.config = {
  rotate: 90,
  align: 'left',
  verticalAlign: 'middle',
  position: 'insideBottom',
  distance: 15,
  onChange: function () {
    const labelOption = {
      rotate: app.config.rotate,
      align: app.config.align,
      verticalAlign: app.config.verticalAlign,
      position: app.config.position,
      distance: app.config.distance
    };
    myChart.setOption({
      series: [
        {
          label: labelOption
        },
        {
          label: labelOption
        },
        {
          label: labelOption
        },
        {
          label: labelOption
        },
        {
          label: labelOption
        },
      ]
    });
  }
};
const labelOption = {
  show: true,
  position: app.config.position,
  distance: app.config.distance,
  align: app.config.align,
  verticalAlign: app.config.verticalAlign,
  rotate: app.config.rotate,
  formatter: '{c}  {name|{a}}',
  fontSize: 16,
  rich: {
    name: {}
  }
};
option = {
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow'
    }
  },
  legend: {
    data: ['Berkas Diproses', 'Berkas Diterima', 'Berkas Ditolak', 'Berkas Terkirim', 'Berkas Gagal Terkirim']
  },
  toolbox: {
    show: true,
    orient: 'vertical',
    left: 'right',
    top: 'center',
    feature: {
      mark: { show: true },
      dataView: { show: true, readOnly: false },
      magicType: { show: true, type: ['line', 'bar', 'stack'] },
      restore: { show: true },
      saveAsImage: { show: true }
    }
  },
  xAxis: [
    {
      type: 'category',
      axisTick: { show: false },
      data: <?php echo json_encode($upt);?>
    }
  ],
  yAxis: [
    {
      type: 'value'
    }
  ],
  series: [
    {
      name: 'Berkas Diproses',
      type: 'bar',
      label: labelOption,
      emphasis: {
        focus: 'series'
      },
      data: <?php echo json_encode($proses);?>
    },
    {
      name: 'Berkas Diterima',
      type: 'bar',
      label: labelOption,
      emphasis: {
        focus: 'series'
      },
      data: <?php echo json_encode($diterima);?>
    },
    {
      name: 'Berkas Ditolak',
      type: 'bar',
      label: labelOption,
      emphasis: {
        focus: 'series'
      },
      data: <?php echo json_encode($ditolak);?>
    },
    {
      name: 'Berkas Terkirim',
      type: 'bar',
      label: labelOption,
      emphasis: {
        focus: 'series'
      },
      data: <?php echo json_encode($kirim);?>
    },
    {
      name: 'Berkas Gagal Terkirim',
      type: 'bar',
      label: labelOption,
      emphasis: {
        focus: 'series'
      },
      data: <?php echo json_encode($gagal);?>
    }
  ]
};

if (option && typeof option === 'object') {
    myChart.setOption(option);
}

        </script>
@endsection