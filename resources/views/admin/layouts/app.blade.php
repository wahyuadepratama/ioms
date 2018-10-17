<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('admin.includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>

  <body onload="message()">
    <div class="wrapper">

      <div class="sidebar" data-color="orange" data-image="{{ URL::asset('admin-panel/assets/img/sidebar.png') }}">

        <!--Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
            Tip 2: you can also add an image using data-image tag-->

          <div class="sidebar-wrapper">
              <div class="logo">
                  <a href="/" class="simple-text">
                      @if(Auth::user()->id_role == 1)
                        {{Config::get('ioms.role.1')}}
                      @elseif(Auth::user()->id_role == 2)
                        {{Config::get('ioms.role.2')}}
                      @elseif(Auth::user()->id_role == 1)
                        {{Config::get('ioms.role.3')}}
                      @endif
                  </a>
              </div>
              <ul class="nav">
                  <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                      <a class="nav-link" href="/">
                          <i class="nc-icon nc-chart-pie-35"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>
                  <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                      <a class="nav-link" href="/profile">
                          <i class="nc-icon nc-circle-09"></i>
                          <p>Profile</p>
                      </a>
                  </li>
                  @if(Auth::user()->id_role == 1)
                  <li class="nav-item {{ Request::is('user-management') ? 'active' : '' }}">
                      <a class="nav-link" href="/user-management">
                          <i class="nc-icon nc-single-02"></i>
                          <p>User Management</p>
                      </a>
                  </li>
                  <li class="nav-item {{ Request::is('admin/history-piket') ? 'active' : '' }}">
                      <a class="nav-link" href="/admin/history-piket">
                          <i class="nc-icon nc-paper-2"></i>
                          <p>History Piket</p>
                      </a>
                  </li>
                  @endif
                  <!-- @if(Auth::user()->id_role == 2)
                  <li class="nav-item {{ Request::is('piket-harian') ? 'active' : '' }}">
                      <a class="nav-link" href="/piket-harian">
                          <i class="nc-icon nc-tap-01"></i>
                          <p>Absen Piket Harian</p>
                      </a>
                  </li>
                  @endif -->
                  <li class="nav-item {{ Request::is('anggota-hmsi') ? 'active' : '' }}">
                      <a class="nav-link" href="/anggota-hmsi">
                          <i class="nc-icon nc-single-copy-04"></i>
                          <p>Anggota HMSI</p>
                      </a>
                  </li>
                  @if(Auth::user()->id_role != 3)
                  <li class="nav-item {{ Request::is('inventaris') ? 'active' : '' }}">
                      <a class="nav-link" href="/inventaris">
                          <i class="nc-icon nc-app"></i>
                          <p>Inventaris</p>
                      </a>
                  </li>
                  <li class="nav-item {{ Request::is('peminjaman') ? 'active' : '' }}">
                      <a class="nav-link" href="/peminjaman">
                          <i class="nc-icon nc-zoom-split"></i>
                          <p>List Peminjaman</p>
                      </a>
                  </li>
                  @endif
                  @if(Auth::user()->id_role == 2)
                  <li class="nav-item {{ Request::is('history-piket') ? 'active' : '' }}">
                      <a class="nav-link" href="/history-piket">
                          <i class="nc-icon nc-paper-2"></i>
                          <p>History Piket</p>
                      </a>
                  </li>
                  @endif
              </ul>
          </div>
      </div>
      <div class="main-panel">

        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class="container-fluid ">
              <a class="navbar-brand" href="#pablo"> {{Auth::user()->nama}} </a>
              <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-bar burger-lines"></span>
                  <span class="navbar-toggler-bar burger-lines"></span>
                  <span class="navbar-toggler-bar burger-lines"></span>
              </button>

                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="no-icon"> {{Auth::user()->nim}}</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="profile">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

      </div>

    </div>

  </body>
  @include('admin.includes.js')
</html>
