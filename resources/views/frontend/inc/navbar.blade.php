 <!-- Navbar -->




 <nav class="main-header navbar navbar-light navbar-white" style="border-bottom: none; box-shadow: 0 -10px 15px rgba(0,0,0,0.25),0 0px 10px rgba(0,0,0,0.22)!important; background-image: linear-gradient(to right, #818cf8, #737bf4, #666af0, #5a59eb, #4f46e5);">
     <div class="container">
         <a href="../../index3.html" class="navbar-brand">
             {{-- <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
             <span class="brand-text font-weight-light text-white">myHome</span>
         </a>

         

         <div class="collapse navbar-collapse order-3" id="navbarCollapse">
             <!-- Left navbar links -->
             {{-- <ul class="navbar-nav">
                 <li class="nav-item">
                     <a href="index3.html" class="nav-link">Home</a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">Contact</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                     <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                         <li><a href="#" class="dropdown-item">Some action </a></li>
                         <li><a href="#" class="dropdown-item">Some other action</a></li>

                         <li class="dropdown-divider"></li>

                         <!-- Level two dropdown-->
                         <li class="dropdown-submenu dropdown-hover">
                             <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                 aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover
                                 for action</a>
                             <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                 <li>
                                     <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                 </li>

                                 <!-- Level three dropdown-->
                                 <li class="dropdown-submenu">
                                     <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown"
                                         aria-haspopup="true" aria-expanded="false"
                                         class="dropdown-item dropdown-toggle">level 2</a>
                                     <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                         <li><a href="#" class="dropdown-item">3rd level</a></li>
                                         <li><a href="#" class="dropdown-item">3rd level</a></li>
                                     </ul>
                                 </li>
                                 <!-- End Level three -->

                                 <li><a href="#" class="dropdown-item">level 2</a></li>
                                 <li><a href="#" class="dropdown-item">level 2</a></li>
                             </ul>
                         </li>
                         <!-- End Level two -->
                     </ul>
                 </li>
             </ul> --}}

         </div>

         <!-- Right navbar links -->
         <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
             <!-- Messages Dropdown Menu -->


             <li class="nav-item">
                 <a href="" class="nav-link text-white">หน้าแรก</a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('login') }}" class="nav-link text-white">login</a>
             </li>
             {{-- <li class="nav-item">
                 <a href="index3.html" class="nav-link text-white">หน้าแรก</a>
             </li> --}}

             
             {{-- <li class="nav-item">
                 <a href="index3.html" class="nav-link text-white">โครงการคอนโด</a>
             </li>


             <li class="nav-item">
                 <a href="index3.html" class="nav-link text-white">เช่า - ซื้อ</a>
             </li> --}}


         </ul>
     </div>
 </nav>
 <!-- /.navbar -->
