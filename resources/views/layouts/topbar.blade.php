<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{Auth::user()->name}}<i class="fas fa-user ml-2"></i><i class="fas fa-sort-down ml-1"></i>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
        <a href="@role('admin') {{route('admin.profil')}}  @endrole" class="text-center dropdown-item "> <img src="{{asset("img/profil/".Auth::user()->foto_profil."")}}" class="img-circle elevation-2 img-size-50 img-fluid" ><br><br></a>
          <a href="@role('admin') {{route('admin.gantiPassword')}}  @endrole" class="dropdown-item">
            <i class="fas fa-key mr-2"></i>
            Ganti Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="@role('admin') {{route('admin.profil')}}  @endrole" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>&nbsp;Profil Saya
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form1').submit();">
                                       <i class="fas fa-sign-out-alt"></i>
                                       &nbsp;Keluar
                                    </a>

            <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>


        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
