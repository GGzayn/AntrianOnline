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

  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xs-6">
            <div class="box box-info">

                <div class="box-header with-border">
                    <h1 > Dashboard {{ Auth::user()->name }}</h1>
                </div>
                <div class="box-body">
                    

                </div>

            </div>
        </div>
    </div>
    

    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Ringkasan Data</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kecamatan</th>
                        <th>Total Antrian</th>
                        <th>Berkas Diterima Kecamatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keca as $row => $val)
                    <tr>
                        <th><?php echo json_encode($row);?></th>
                        <th><?php echo json_encode($val['antrian']);?></th>
                        <th><?php echo json_encode($val['bTerima']);?></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
      data: <?php echo json_encode($kecamatan);?>
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