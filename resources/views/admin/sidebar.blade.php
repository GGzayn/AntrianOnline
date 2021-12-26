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
        <li><a href="{{route('admin.opds.index')}}"><i class="fa fa-building"></i> <span>Opd</span></a></li>
        <li><a href="{{route('admin.akuns.index')}}"><i class="fa fa-users"></i> <span>Akun Dinas</span></a></li>
        <li><a href="{{route('admin.uptsAcc.index')}}"><i class="fa fa-users"></i> <span>Akun UPT</span></a></li>
        <li><a href="{{route('admin.upts.index')}}"><i class="fa fa-building"></i> <span>UPT</span></a></li>
        <li><a href="{{route('admin.a_kecamatans.index')}}"><i class="fa fa-users"></i> <span>Akun Kecamatan</span></a></li>
        <li><a href="{{route('admin.a_kelurahans.index')}}"><i class="fa fa-users"></i> <span>Akun Kelurahan</span></a></li>
        <li><a href="{{route('admin.syarats.index')}}"><i class="fa fa-users"></i> <span>Syarat Layanan</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        @elseif(Auth::user()->role_id == 2)
        <li><a href="{{route('dinas.dashboard.index')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="{{route('dinas.layanans.index')}}"><i class="fa fa-file"></i> <span>Layanan</span></a></li>
        <li><a href="{{route('dinas.lokets.index')}}"><i class="fa fa-file"></i> <span>Loket</span></a></li>
        <li><a href="{{route('dinas.offlines.index')}}" target="_blank"><i class="fa fa-registered"></i> <span>Register offline</span></a></li>
        <li><a href="{{route('dinas.berkasMasuk')}}"><i class="fa fa-file-text-o"></i> <span>Berkas Masuk</span></a></li>
        <li><a href="{{route('dinas.documents.index')}}"><i class="fa fa-file-text-o"></i> <span>Berkas Keluar</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        @elseif(Auth::user()->role_id == 3)
        <li><a href="{{route('loket.antrians.index')}}"><i class="fa fa-file"></i> <span>Antrian</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        @elseif(Auth::user()->role_id == 4)
        <li><a href="{{route('kecamatan.dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="{{route('kecamatan.a_kelurahans.index')}}"><i class="fa fa-file"></i> <span>Akun Kelurahan</span></a></li>
        <li><a href="{{route('kecamatan.lokets.index')}}"><i class="fa fa-file"></i> <span>Loket</span></a></li>
        <li><a href="{{route('kecamatan.documents.index')}}"><i class="fa fa-file-text-o"></i><span>Berkas Kecamatan</span></a></li>
        <li><a href="{{route('kecamatan.berkasTercetak')}}"><i class="fa fa-file-text-o"></i><span>Berkas Dinas</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        <li><a href="{{route('kecamatan.offlines.index')}}" target="_blank"><i class="fa fa-registered"></i> <span>Register offline</span></a></li>
        @elseif(Auth::user()->role_id == 5)
        <li><a href="{{route('loketKecamatan.antrians.index')}}"><i class="fa fa-file"></i> <span>Antrian</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        @elseif(Auth::user()->role_id == 6)
        <li><a href="{{route('kelurahan.kelurahanBerkas')}}"><i class="fa fa-file-text"></i> <span>Berkas Tercetak</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        @elseif(Auth::user()->role_id == 7)
        <li><a href="{{route('upt.antrians.index')}}"><i class="fa fa-file"></i> <span>Antrian</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        @elseif(Auth::user()->role_id == 8)
        <li><a href="{{route('adminUpt.dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="{{route('adminUpt.lokets.index')}}"><i class="fa fa-file"></i> <span>Loket</span></a></li>
        <li><a href="{{route('adminUpt.documents.index')}}"><i class="fa fa-file-text-o"></i><span>Berkas Upt</span></a></li>
        <li><a href="{{route('adminUpt.berkasTercetak')}}"><i class="fa fa-file-text-o"></i><span>Berkas Dinas</span></a></li>
        <li><a href="{{route('laporan')}}"><i class="fa fa-file-text-o"></i> <span>Laporan Berkas</span></a></li>
        <li><a href="{{route('adminUpt.offlines.index')}}" target="_blank"><i class="fa fa-registered"></i> <span>Register offline</span></a></li>
        @endif
        
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>