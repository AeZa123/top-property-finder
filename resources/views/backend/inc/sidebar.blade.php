 
 
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
         <div class=" mt-3 pb-3 mb-3 d-flex">
             <div >
                 <img class="brand-image img-circle elevation-3" style="background-size:cover; background-position:center; opacity: .8" width="40px" height="40px" src="{{ asset('storage/images/users/'. Auth::user()->avatar) }}" 
                     alt="User Image">
             </div>
             <div class="info ml-2 mt-1">
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
                 <li class="nav-item">
                     <a href="{{ route('users') }}" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Users</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('posts') }}" class="nav-link">
                         {{-- <i class="nav-icon fas fa-users"></i> --}}
                         <i class="nav-icon fas fa-bullhorn"></i>
                         {{-- <i class="nav-icon far fa-bullhorn"></i> --}}
                         <p>Announce</p>
                     </a>
                 </li>
                 
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
