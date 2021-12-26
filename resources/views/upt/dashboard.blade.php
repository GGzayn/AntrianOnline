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
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xs-6">
        <div class="box box-default">

          <div class="box-header with-border">
            <h1 > Dashboard {{ Auth::user()->name }}</h1>
          </div>
          <div class="box-body">

          </div>

        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Antrian/Loket</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="pie" style="height: 300px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                    <div id="pie_2" style="height: 300px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Ringkasan Data Berkas</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="pie_3" style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Antrian</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="container" style="height: 400px"></div>
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



    option = {
    xAxis: {
        type: 'category',
        data: <?php echo json_encode($namabul)?>
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
        data: <?php echo json_encode($val)?>,
        type: 'bar',
        showBackground: true,
        backgroundStyle: {
            color: 'rgba(180, 180, 180, 0.2)'
        }
        }
    ]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

</script>
<script type="text/javascript">
    var dom = document.getElementById("pie");
    var myChart = echarts.init(dom);
    var app = {};

    var option;



    option = {
    tooltip: {
        trigger: 'item'
    },
    legend: {
        top: '3%',
        left: 'center'
    },
    series: [
        {
        name: 'Total Antrian',
        type: 'pie',
        radius: ['40%', '70%'],
        avoidLabelOverlap: false,
        itemStyle: {
            borderRadius: 10,
            borderColor: '#fff',
            borderWidth: 2
        },
        label: {
            show: false,
            position: 'center'
        },
        emphasis: {
            label: {
            show: true,
            fontSize: '16',
            fontWeight: 'bold'
            }
        },
        labelLine: {
            show: true
        },
        data: <?php echo json_encode($asus)?>
        }
    ]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

</script>
<script type="text/javascript">
    var dom = document.getElementById("pie_2");
    var myChart = echarts.init(dom);
    var app = {};

    var option;



    option = {
    tooltip: {
        trigger: 'item'
    },
    legend: {
        top: '3%',
        left: 'center'
    },
    series: [
        {
        name: 'Data',
        type: 'pie',
        radius: ['40%', '70%'],
        avoidLabelOverlap: false,
        itemStyle: {
            borderRadius: 10,
            borderColor: '#fff',
            borderWidth: 2
        },
        label: {
            show: false,
            position: 'center'
        },
        emphasis: {
            label: {
            show: true,
            fontSize: '12',
            fontWeight: 'bold'
            }
        },
        labelLine: {
            show: true
        },
        data: <?php echo json_encode($data)?>
        }
    ]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

</script>
<script type="text/javascript">
    var dom = document.getElementById("pie_3");
    var myChart = echarts.init(dom);
    var app = {};

    var option;



    option = {
    tooltip: {
        trigger: 'item'
    },
    legend: {
        top: '3%',
        left: 'center'
    },
    series: [
        {
        name: 'Data',
        type: 'pie',
        radius: ['40%', '60%'],
        avoidLabelOverlap: false,
        itemStyle: {
            borderRadius: 10,
            borderColor: '#fff',
            borderWidth: 2
        },
        label: {
            show: false,
            position: 'center'
        },
        emphasis: {
            label: {
            show: true,
            fontSize: '10',
            fontWeight: 'bold'
            }
        },
        labelLine: {
            show: true
        },
        data: <?php echo json_encode($data_2)?>
        }
    ]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

</script>

@endsection