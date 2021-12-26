@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create Akun UPT
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Akun UPT</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="box">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Form Create Akun UPT</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="{{route('admin.uptsAcc.store')}}" method="post" class="form-horizontal">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="text" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Role</label>

                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="role" required>
                                @foreach($role as $row)
                                    <option value = "{{$row->id}}"  id="role">{{$row->role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="upt" class="col-sm-2 control-label">UPT</label>

                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="upt" required>
                                @foreach($upt as $row)
                                    <option value = "{{$row->id}}" id="upt">{{$row->upt}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">SUBMIT</button>
                </div>
                <!-- /.box-footer -->
              </form>
          </div>
        </div>
      </div>
    </section>

@endsection
