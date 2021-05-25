<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte')}}/dist/img/avatar04.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <p>{{ Auth::user()->role->role }}</p>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Auth::user()->role_id == 1)
        <!-- <li class="header">MASTER DATA</li> -->
        <li><a href="{{route('admin.layanans.index')}}"><i class="fa fa-circle"></i> <span>Layanan</span></a></li>
        <li><a href="{{route('admin.lokets.index')}}"><i class="fa fa-circle"></i> <span>Loket</span></a></li>
        <li><a href="{{route('admin.opds.index')}}"><i class="fa fa-circle"></i> <span>Opd</span></a></li>
        <li><a href="{{route('admin.akuns.index')}}"><i class="fa fa-circle"></i> <span>Akun Dinas</span></a></li>

        @elseif(Auth::user()->role_id == 2)
        <li><a href="{{route('dinas.layanans.index')}}"><i class="fa fa-circle"></i> <span>Layanan</span></a></li>
        <li><a href="{{route('dinas.lokets.index')}}"><i class="fa fa-circle"></i> <span>Loket</span></a></li>
        <li><a href="{{route('dinas.offlines.index')}}" target="_blank"><i class="fa fa-circle"></i> <span>Register offline</span></a></li>

        @elseif(Auth::user()->role_id == 3)
        <li><a href="{{route('loket.lokets.index')}}"><i class="fa fa-circle"></i> <span>Loket</span></a></li>
        @endif
        
        
        
        
        
        
        
        
     
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>