<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="@if(Auth::user()->hasRole('admin')){{route('admin.dashboard')}}@elseif(Auth::user()->hasRole('dosen')){{route('dosen.dashboard')}}
        @elseif(Auth::user()->hasRole('mahasiswa')){{route('mahasiswa.dashboard')}}@else Undifined @endif" class="brand-link">
      <img src="{{asset('AdminLte3/img/unnes.png')}}" alt="Logo" class="brand-image img-circle elevation-2"
           style="opacity: .8">
           <!-- http://kecantikan.unnes.ac.id/wp-content/uploads/2018/01/logo-pkk-2018-300x66.png -->
      <span class="brand-text font-weight-light">SI IPAL </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("img/profil/".Auth::user()->foto_profil."")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
          (
          @if(Auth::user()->hasRole('admin'))
          admin
          @elseif(Auth::user()->hasRole('dosen'))
          Dosen
          @elseif(Auth::user()->hasRole('mahasiswa'))
          Mahasiswa
          @else
          Undifined
          @endif
          )
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="@if(Auth::user()->hasRole("admin")) {{route('admin.dashboard')}}  @endif" class="nav-link @if(request()->routeIs('admin.dashboard')) active @else @endif">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                <p>Dashboard</p>
            </a>
            </li>

            @role('admin')
          <li class="nav-header">Manajemen User</li>
          <li class="nav-item">
            <a href="{{route('admin.manajemen_user.index')}}" class="nav-link {{ request()->routeIs('admin.manajemen_user.index')?'active':''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manajemen User
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          @endrole


          @role('admin')
          <li class="nav-header">Data Master</li>

          <li class="nav-item">
            <a href="@role('admin') {{route('admin.manajemen_barang.index')}} @else {{route('dosen.manajemen_barang.index')}} @endrole" class="nav-link {{ request()->routeIs('admin.manajemen_barang.index') ||Request::is("admin/manajemen_barang/*")?'active':''}}">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>
                Data Barang
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="@role('admin') {{ route('admin.penjualan_barang.index')}} @endrole" class="nav-link {{ request()->routeIs('admin.penjualan_barang.index')|| Request::is('admin/penjualan_barang/*')?'active':''}}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Penjualan
                {{-- <span class="badge badge-info right">2</span> --}}
              </p>
            </a>
          </li>

          @endrole

          {{-- @endif --}}
          <li class="nav-header">Akun</li>
          <li class="nav-item">
            <a href="@if(Auth::user()->hasRole("admin")) {{route('admin.profil')}} @elseif(Auth::user()->hasRole("dosen")) {{route('dosen.profil')}} @else {{route('mahasiswa.profil')}} @endif" class="nav-link @if(request()->routeIs('admin.profil')||request()->routeIs('dosen.profil')||request()->routeIs('mahasiswa.profil')) active @else @endif">
                <i class="fas fa-user nav-icon"></i>
                <p>Profil</p>
            </a>
            </li>

          <li class="nav-item">
            <a href="@if(Auth::user()->hasRole("admin")) {{route('admin.gantiPassword')}} @elseif(Auth::user()->hasRole("dosen")) {{route('dosen.gantiPassword')}} @else {{route('mahasiswa.gantiPassword')}} @endif" class="nav-link @if(request()->routeIs('admin.gantiPassword')||request()->routeIs('dosen.gantiPassword')||request()->routeIs('mahasiswa.gantiPassword')) active @else @endif">
                <i class="fas fa-key nav-icon"></i>
                <p>Ganti Password</p>
            </a>
            </li>
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
             <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fas fa-sign-out-alt nav-icon"></i><p> {{__('Keluar')}}</p>
                                    </a>


          </li>
          <br><br><br><br>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
