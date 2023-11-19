@extends('frontend.layouts.home_layout')


@section('content')
    <div class="container-fluid bg-white p-0">



        <div class="container-xxl py-5">
            <div class="container">


                <!-- Search Start -->
                <h1 class="text-center" style="margin-top: 10%;">ค้นหา</h1>
                <div class="container bg-primary mb-5"
                    style="padding: 35px; border-radius: 12px;">
                    
                    <div class="container">
                        <form action="{{ route('search.property') }}" method="get">
                       
                            <div class="row g-2">
                                <div class="col-md-10">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" name="keyword" class="form-control border-0 py-3"
                                                placeholder="Search Keyword">
                                        </div>
                                        <div class="col-md-4">
                                            <select name="property_type_id" class="form-select border-0 py-3">
                                                <option value="" selected>Property Type</option>
                                                <?php echo $data_html_proper_type; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="provinces_id" class="form-select border-0 py-3">
                                                <option value="" selected>จังหวัด</option>
                                                <?php echo $data_html_thai_provinces; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Search End -->








                <div class="row g-0 gx-5 align-items-end" style="margin-top:10%;">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">ผลการค้นหา</h1>
                            {{-- <h1 class="mb-3">Property Listing</h1> --}}
                            {{-- <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum
                                sit
                                eirmod sit diam justo sed rebum.</p> --}}
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($datas as $data)
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ url('detail/property/' . $data->id) }}"><img class="img-fluid"
                                                    src="{{ asset('storage/images/property_image/image_cover/' . $data->image_cover) }}"
                                                    alt=""></a>
                                            {{-- <a href=""><img class="img-fluid" src="{{ asset('template/img/property-1.jpg') }}" alt=""></a> --}}
                                            <div
                                                class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                {{ $data->name_sale_type }}</div>
                                            <div
                                                class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                                {{ $data->name_property_type }}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">{{ $data->price_format }} THB</h5>
                                            <a class="d-block h5 mb-2" href="{{ url('detail/property/' . $data->id) }}"
                                                title="{{ $data->title }}">{{ Str::limit($data->title, 40, '...') }}</a>
                                            <span
                                                title="{{ $data->property_name }}">{{ Str::limit($data->property_name, 50, '...') }}</span>
                                            <p></p>
                                            {{-- <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                            </p> --}}
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i
                                                    class="fa fa-ruler-combined text-primary me-2"></i>{{ $data->area }}
                                                ตรม.</small>
                                            <small class="flex-fill text-center border-end py-2"><i
                                                    class="fa fa-bed text-primary me-2"></i>{{ $data->bedroom }}
                                                Bed</small>
                                            <small class="flex-fill text-center py-2"><i
                                                    class="fa fa-bath text-primary me-2"></i>{{ $data->bathroom }}
                                                Bath</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-1.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Sell</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Appartment</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2
                                            Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-2.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Rent</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Villa</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2
                                            Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-3.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Sell</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Office</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2
                                            Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-4.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Rent</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Building</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-5.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Sell</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Home</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-6.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Rent</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Shop</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-1.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Sell</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Appartment</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-2.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Rent</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Villa</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-3.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Sell</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Office</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-4.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Rent</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Building</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-5.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Sell</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Home</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid"
                                                src="{{ asset('template/img/property-6.jpg') }}" alt=""></a>
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            For Rent</div>
                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            Shop</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">$12,345</h5>
                                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- {{ $datas->links() }} --}}



            </div>
        </div>





        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
@endsection
