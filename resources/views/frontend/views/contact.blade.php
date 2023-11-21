@extends('frontend.layouts.home_layout')


@section('content')
    <style>
        .carousel-item img {
            /* filter: brightness(120%) contrast(90%) saturate(120%);
         */
            /* filter: blur(3px); */
            filter: drop-shadow(8px 8px 10px gray);
        }
    </style>

    <br><br><br><br>


    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/carousel/test1.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>

    </div>


    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">


        <div class="row justify-content-center mt-5">


            <div class="col-md-8 mt-3">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <h6>CONTACT ยังไม่ได้แก้</h6>
                            <h2>WHAT WE’RE ALL ABOUT</h2>
                            <p>Whether you’re buying or selling, we are here to help you through every step of the process.</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                       <img style="border-radius: 13px;" class="" width="80%" height="auto" src="{{ asset('images/carousel/carousel_1.jpg') }}" alt="">
                    </div>
                </div>
            </div>

        </div>

    </div>


    



    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
@endsection
