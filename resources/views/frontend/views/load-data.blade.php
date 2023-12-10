@foreach ($datas as $data)
    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
        <div class="property-item rounded overflow-hidden">
            <div class="position-relative overflow-hidden">
                <a href="{{ url('detail/property/' . $data->id) }}"><img class="img-fluid"
                        src="{{ asset('storage/images/property_image/image_cover/' . $data->image_cover) }}"
                        alt=""></a>
                {{-- <a href=""><img class="img-fluid" src="{{ asset('template/img/property-1.jpg') }}" alt=""></a> --}}
                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                    {{ $data->name_sale_type }}</div>
                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                    {{ $data->name_property_type }}</div>
            </div>


            <div class="p-4 pb-0">
                <h5 class="text-primary mb-3">{{ $data->price_format }} THB</h5>
                <a class="d-block h5 mb-2" href="{{ url('detail/property/' . $data->id) }}"
                    title="{{ $data->title }}">{{ Str::limit($data->title, 30, '...') }}</a>
                {{-- href="{{ url('detail/property/' . $data->id) }}">{{ str_limit($data->title, 50, '...') }}</a> --}}
                <span title="{{ $data->property_name }}">{{ Str::limit($data->property_name, 80, '...') }}</span>
                {{-- <span>{{ $data->property_name }}</span> --}}
                <p></p>
                {{-- <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA
                                        </p> --}}
            </div>
            <div class="d-flex border-top">
                <small class="flex-fill text-center border-end py-2"><i
                        class="fa fa-ruler-combined text-primary me-2"></i>{{ $data->area }} ตรม.</small>
                <small class="flex-fill text-center border-end py-2"><i
                        class="fa fa-bed text-primary me-2"></i>{{ $data->bedroom }} Bed</small>
                <small class="flex-fill text-center py-2"><i
                        class="fa fa-bath text-primary me-2"></i>{{ $data->bathroom }} Bath</small>
            </div>
        </div>
    </div>
@endforeach
