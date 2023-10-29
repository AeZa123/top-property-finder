@extends('frontend.layouts.app')




@section('content')
    <!-- Content Wrapper. Contains page content -->

    <style>
        .rounded-border {
            border-radius: 10px;
        }

        .rounded-top {
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }
    </style>


    @include('frontend.inc.carousel')

    <div class="content">
        <div class="container">

            <div class="">

                <div class="row justify-content-center mt-3">
                    <div class="col-lg-12">
                        <div class="card shadow-lg" style="margin-top: -60px; z-index: 100; border-radius: 15px">
                            <div class="card-body">
                                <h3>Search</h3>

                                <form class="form-inline">


                                    <input type="text" class="form-control col-md-11 mr-2" id=""
                                        placeholder="col-form-label">

                                    <button type="submit" class="btn btn-primary my-1">Search</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- card icon --}}
                <div class="row mt-5">
                    <div class="col-md-12 mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row justify-content-between text-center">
                                    <div class="col-md-4">
                                        <i class="fas fa-home fa-lg"></i><br>
                                        คอนโด
                                    </div>
                                    <div class="col-md-4">
                                        <i class="fas fa-home fa-lg"></i><br>
                                        บ้าน
                                    </div>
                                    <div class="col-md-4">
                                        <i class="fas fa-home fa-lg"></i><br>
                                        ตึกแถว
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- card --}}
                <div class="row mt-5">

                    {{-- <div class="col-md-6">
                        <h5>Property</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <h5>Test</h5>
                    </div> --}}

                    <div class="col-md-12 text-center">
                        <h2>อสังหาฯ ใหม่แนะนำ</h2>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus dicta ducimus
                                    tempore assumenda, expedita deserunt enim magnam architecto voluptatem esse eum numquam
                                    vero, repellat harum iusto eos, ab illo aspernatur!</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card rounded-border">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s"
                                class="card-img-top rounded-top" alt="...">

                            {{-- body card --}}
                            <div class="card-body">
                                <div>
                                    <span></span>
                                </div>
                                <h5 class="card-title"><b>Property Name</b></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                    of the card's content.....</p>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- footer card --}}
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-6 text-muted">
                                        updated 3 mins ago
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" class="bg-red px-3 py-1" style="border-radius: 15px">
                                            view
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card rounded-border">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s"
                                class="card-img-top rounded-top" alt="...">

                            {{-- body card --}}
                            <div class="card-body">
                                <div>
                                    <span></span>
                                </div>
                                <h5 class="card-title"><b>Property Name</b></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                    of the card's content.....</p>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- footer card --}}
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-6 text-muted">
                                        updated 3 mins ago
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" class="bg-red px-3 py-1" style="border-radius: 15px">
                                            view
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card rounded-border">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s"
                                class="card-img-top rounded-top" alt="...">

                            {{-- body card --}}
                            <div class="card-body">
                                <div>
                                    <span></span>
                                </div>
                                <h5 class="card-title"><b>Property Name</b></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                    of the card's content.....</p>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- footer card --}}
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-6 text-muted">
                                        updated 3 mins ago
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" class="bg-red px-3 py-1" style="border-radius: 15px">
                                            view
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>



                <div class="row" style="margin-top: 15%">

                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                                <h5><b>Property</b></h5>
                            </div>

                            <div class="col-md-8 text-center">
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem ea eveniet
                                    placeat culpa? Nostrum doloribus ut illum officiis molestiae odio eos tenetur, minus
                                    odit nemo et voluptas iste voluptatem fugiat!</p>
                            </div>


                        </div>
                    </div>




                    <div class="col-md-6">
                        <div class="card mb-3" >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img width="185" height="197" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Card title</b></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>
            
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                                    </div>
                                                </div>


                                                <div class="col-md-7">
                                                    <small class="text-muted card-text">Last updated 3 mins ago</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="">
                                                        <span class="card-text float-right bg-red px-3" style="border-radius: 15px;">view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img width="185" height="197" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Card title</b></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>
            
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                                    </div>
                                                </div>


                                                <div class="col-md-7">
                                                    <small class="text-muted card-text">Last updated 3 mins ago</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="">
                                                        <span class="card-text float-right bg-red px-3" style="border-radius: 15px;">view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img width="185" height="197" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Card title</b></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>
            
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                                    </div>
                                                </div>


                                                <div class="col-md-7">
                                                    <small class="text-muted card-text">Last updated 3 mins ago</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="">
                                                        <span class="card-text float-right bg-red px-3" style="border-radius: 15px;">view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img width="185" height="197" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Card title</b></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>
            
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                                    </div>
                                                </div>


                                                <div class="col-md-7">
                                                    <small class="text-muted card-text">Last updated 3 mins ago</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="">
                                                        <span class="card-text float-right bg-red px-3" style="border-radius: 15px;">view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <div class="col-md-6">
                        <div class="card mb-3 " >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img width="185" height="197" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Card title</b></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>
            
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                                    </div>
                                                </div>


                                                <div class="col-md-7">
                                                    <small class="text-muted card-text">Last updated 3 mins ago</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="">
                                                        <span class="card-text float-right bg-red px-3" style="border-radius: 15px;">view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img width="185" height="197" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX814i1YAhcte3vjS-py2x1V86k9pUVSbZqIZSB8q7xg&s" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Card title</b></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bed fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>
            
                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-bath fa-sm mr-1"></i> 2 ห้อง
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <i class="fas fa-tree fa-sm mr-1"></i> 39 ตรม.
                                                    </div>
                                                </div>


                                                <div class="col-md-7">
                                                    <small class="text-muted card-text">Last updated 3 mins ago</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="">
                                                        <span class="card-text float-right bg-red px-3" style="border-radius: 15px;">view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  


                </div>


                <br>


                {{-- สำคัญ --}}
                {{-- <div class="row mt-5 mb-5">
                    <div class="col-md-12">
                        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-touch="true"
                            data-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">

                                    <div class="row p-2">
                                        <div class="col-md-4 ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>

                                        <div class="col ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>

                                        <div class="col-md-4 ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                        <div class="col ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <div class="col ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>

                                        <div class="col-md-4 ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>

                                        <div class="col ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                        <div class="col-md-4 ml-1 mr-1" style="padding-right: 0px; padding-left: 0px;">
                                            <img class="rounded-border" width="100%" height="100%"
                                                src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100"
                                                alt="...">
                                        </div>

                                    </div>





                                </div>





                                <div class="carousel-item">
                                    <img src="..." class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="..." class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-target="#carouselExampleControlsNoTouching" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-target="#carouselExampleControlsNoTouching" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                </div> --}}


                {{-- <div class="row mb-5">
                    <div class="col-md-12">
                        <h5>อสังหาฯ ใหม่แนะนำ</h5>
                    </div>

                    <div class="col-md-6 d-flex" style="align-items: center;">
                        <div>
                            <h6>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </h6>
                        </div>
                        <div>
                            <img src="https://www.livinginsider.com/assets18/images/property_new/Condo_new.png"
                                alt="">
                        </div>

                    </div>

                    <div class="col-md-6 d-flex" style="align-items: center;">
                        <div>
                            <h6>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </h6>
                        </div>
                        <div>
                            <img src="https://www.livinginsider.com/assets18/images/property_new/Condo_new.png"
                                alt="">
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>
        <!-- /.content-wrapper -->
    @endsection
