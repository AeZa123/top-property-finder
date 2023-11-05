  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          {{-- <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
          </li> --}}
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            
              <a class="nav-link rounded-pill  d-none d-lg-flex" href="{{ route('home') }}" target="_blank"><b><i class="fas fa-home"></i> Home</b></a>
          </li>
          <li class="nav-item">
              {{-- <a href="{{ route('logout') }}" class="nav-link">logout</a> --}}
              <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                  {{ __('Logout') }} 
                <i class="fas fa-sign-out-alt ml-1"></i>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
