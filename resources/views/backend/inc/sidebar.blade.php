 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link text-center">
         {{-- <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
         <span class="brand-text font-weight-light">Top Property Finder</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('storage/images/users/' . Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         {{-- <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div> --}}

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">

                 <li class="nav-header">Management</li>
                 @if ( Auth::user()->role != '3' )
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                 @endif

                 @if ( Auth::user()->role == '1' )
                 <li class="nav-item">
                     <a href="{{ route('users') }}" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Users</p>
                     </a>
                 </li>   
                 @endif

                 @if ( Auth::user()->role == '1' or Auth::user()->role == '2' )
                 <li class="nav-item">
                     <a href="{{ route('posts') }}" class="nav-link">
                         {{-- <i class="nav-icon fas fa-users"></i> --}}
                         <i class="nav-icon fas fa-bullhorn"></i>
                         {{-- <i class="nav-icon far fa-bullhorn"></i> --}}
                         <p>Announce</p>
                     </a>
                 </li>
                 @endif

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
