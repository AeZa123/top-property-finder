@extends('frontend.layouts.home_layout')


{{-- <link rel="stylesheet" href="{{asset('lib_gallery/css/cwa_main.css')}}"> --}}



@section('content')
    {{-- <link rel="preload" href="{{asset('lib_gallery/css/cwa_main.css')}}" as="style"/>  --}}
    <link href ="{{ asset('lib_gallery/css/cwa_main.css') }}" rel ="stylesheet" type="text/css">



    <div class="container-fluid bg-white p-0">


        <!-- About Start -->
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row align-items-center">
                {{-- <div class="row g-5 align-items-center"> --}}
                    <h1 style="margin-top: 10%;">{{ $data->property_name }}</h1>
                    <hr style="margin-bottom: 3%;">
                   
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" >
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100"
                                src="{{ asset('storage/images/property_image/image_cover/' . $data->image_cover) }}">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="mb-2">{{ $data->title }}</h3>
                        <h5 class="mb-2">{{ $data->property_name }}</h5>
                        <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                        {{-- <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <div class="container-fluid mt-5">

            <div class="container">
                <div class="row">
                    <h1>รายละเอียด</h1>
                    <hr>
                    <div class="col-md-6">
                        <p class="mb-3">{{ $data->body }}</p>
                        
                    </div>
                </div>
            </div>

        </div>


        <!-- gallery Start -->
        <div class="container-fluid mt-5">
            <div class="container">

                <div class="row">
                    <h1>รูปภาพ</h1>
                    <hr>

                </div>

                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="image-container">
                                @foreach ($images as $image)
                                    <a class="cwa-lightbox-image text-center"
                                        href="{{ asset('storage/images/property_image/' . $image->image_name) }}"
                                        data-desc="">
                                        <img class="rounded"
                                            src="{{ asset('storage/images/property_image/' . $image->image_name) }}"
                                            alt="" loading="lazy" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                

            </div>
        </div>
        <!-- gallery End -->

        <!-- Call to Action Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded-circle" src="{{ asset('storage/images/users/' . $data->avatar) }}" alt="avatar">
                                {{-- <img class="img-fluid rounded w-100" src="img/call-to-action.jpg" alt=""> --}}
                            </div>
                            <div class="col-lg-8 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">ติดต่อเอเจ้นท์ที่ "จริงใจ"</h1>
                                    <i class="fas fa-user-check text-primary"></i> : {{ $data->fname }} {{ $data->lname }} <br>
                                    <i class="fas fa-phone-square-alt text-primary"></i> : {{ $data->tel }}  <br>
                                    <i class="fas fa-envelope text-primary"></i> : {{ $data->email }} <br>
                                    <i class="fab fa-line text-primary"></i> :  <br>
                                    <i class="fab fa-facebook-square text-primary"></i>  :
                                    
                                </div>
                                {{-- <a href="" class="btn btn-primary py-3 px-4 me-2"><i
                                        class="fa fa-phone-alt me-2"></i>Make A Call</a>
                                <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get
                                    Appoinment</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>




    <script src="{{ asset('lib_gallery/js/cwa_lightbox_bundle_v1.js') }}" defer></script>
@endsection
