<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="assets/favicon.ico" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Lelang-Lelong</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Orang-orangan sawah</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          @if (auth()->user()->level == 'admin') 
          <li class="nav-item">
            <a href="{{route('barang.index')}}" class="nav-link">
            <i class="fa fa-database nav-icon" aria-hidden="true"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
          @endif @if (auth()->user()->level == 'admin') 
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
            <i class="fa fa-database nav-icon" aria-hidden="true"></i>
              <p>
                Data User
              </p>
            </a>
          </li>
          @endif
        @if (auth()->user()->level == 'petugas') 
        <li class="nav-item">
          <a href="{{route('barang.index')}}" class="nav-link">
          <i class="fa fa-database nav-icon" aria-hidden="true"></i>
            <p>
              Data Barang
            </p>
          </a>
        </li>
        @endif
        @if (auth()->user()->level == 'petugas') 
        <li class="nav-item">
          <a href="{{route('lelang.index')}}" class="nav-link">
          <i class="fa fa-database nav-icon" aria-hidden="true"></i>
            <p>
              Data Lelang
            </p>
          </a>
        </li>
        @endif
        @if (auth()->user()->level == 'masyarakat') 
        <strong>Masyarakat</strong>
        <li class="nav-item">
          <a href="{{route('dashboard.masyarakat')}}" class="nav-link">
            <i class="fa fa-database nav-icon" aria-hidden="true"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endif
        @if (auth()->user()->level == 'masyarakat') 
        <li class="nav-item">
          <a href="{{route('lelang.index')}}" class="nav-link">
          <i class="fa fa-database nav-icon" aria-hidden="true"></i>
            <p>
              Data Lelang
            </p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{route('logout.petugas')}}" class="nav-link">
            <i class="fa-solid fa-person-through-window"></i>
            <p>
              Logout  
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>