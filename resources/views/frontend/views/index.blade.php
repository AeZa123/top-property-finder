@extends('frontend.layouts.app')




@section('content')
    <!-- Content Wrapper. Contains page content -->

    <style>
        .rounded-border {
            border-radius: 10px;
        }
    </style>


    @include('frontend.inc.carousel')

    <div class="content">
        <div class="container">

            <div class="">

                <div class="row justify-content-center mt-3">
                    <div class="col-lg-12 text-center">
                        <div class="card shadow-lg " style="margin-top: -60px; z-index: 100; border-radius: 15px">
                            <div class="card-body">
                                <h3>Search </h3>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row justify-content-between text-center">
                                    <div class="col-md-4">คอนโด</div>
                                    <div class="col-md-4">บ้าน</div>
                                    <div class="col-md-4">ที่ดิน</div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                <br>
                <div class="row mt-5 mb-5">
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



                                    {{-- <img src="{{ asset('assets/images/carousel/myHome.png') }}" class="d-block w-100" alt="..."> --}}




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
                </div>


                <div class="row mb-5">
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
                            <img src="https://www.livinginsider.com/assets18/images/property_new/Condo_new.png" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
    @endsection
