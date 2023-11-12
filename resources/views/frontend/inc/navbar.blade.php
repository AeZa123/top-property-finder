<style>
    .nav-bar1 {
        padding: 0px;
        z-index: 9999;
        overflow: hidden;
        position: fixed;
        top: 0;
        width: 100%;
    }
    /* .nav-bar.sticky-top {
        position: sticky;
        padding: 0;
        z-index: 9999;
    } */
</style>
    
    <!-- Navbar Start -->
    <div class="container-fluid nav-bar1 bg-transparent" >
    {{-- <div class="container-fluid nav-bar bg-transparent"> --}}
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        {{-- <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4"> --}}
            <a href="#" class="navbar-brand d-flex align-items-center text-center">
                <div class="icon p-2 me-2">
                    <img class="img-fluid" src="{{ asset('template/img/icon-deal.png') }}" alt="Icon"
                        style="width: 30px; height: 30px;">
                </div>
                <h1 class="m-0 text-primary">Top Property finder</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="#" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="property-list.html" class="dropdown-item">Property List</a>
                            <a href="property-type.html" class="dropdown-item">Property Type</a>
                            <a href="property-agent.html" class="dropdown-item">Property Agent</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>



                    @guest
                        @if (Route::has('login'))
                            {{-- <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li> --}}
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}" class="nav-item nav-link">dashboard</a>

                    @endguest













                </div>



                <a style="margin-right: 8px;" href="{{ route('post.create') }}" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>

                
                @guest
                    {{-- @if (Route::has('login'))
                    @endif --}}
                @else
                    <a class="btn btn-danger d-none d-lg-flex" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest

            </div>
        </nav>
    </div>
    <!-- Navbar End -->
