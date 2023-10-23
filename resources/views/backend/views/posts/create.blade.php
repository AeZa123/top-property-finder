@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->

    <style>
        .star-req {
            color: red;
        }
    </style>


    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">สร้างปรกาศ</h3>
                        </div>

                        <form id="form" method="POST" action="{{ route('post.storage') }}" enctype="multipart/form-data">
                            {{-- <form id="form" method="POST" action="" enctype="multipart/form-data"> --}}
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">หัวข้อ<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="หัวข้อ">
                                                    <span class="text-danger font-danger error-text title_error"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="amount">จำนวน<span
                                                                    class="star-req">*</span></label>
                                                            <input type="text" class="form-control" name="amount"
                                                                id="amount" placeholder="จำนวน">
                                                            <span
                                                                class="text-danger font-danger error-text amount_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price">ราคา<span
                                                                    class="star-req">*</span></label>
                                                            <input type="text" class="form-control" name="price"
                                                                id="price" placeholder="ราคา">
                                                            <span
                                                                class="text-danger font-danger error-text price_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="property_name">ชื่ออสังหา<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="property_name" id="property_name"
                                                        placeholder="ชื่ออสังหา">
                                                    <span class="text-danger font-danger error-text property_name_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="property_type_id">ประเภทอสังหา<span class="star-req">*</span></label>
                                                            <select class="form-control" name="property_type_id">
                                                                <option value="">เลือกประเภทอสังหา</option>
                                                                @foreach ($property_type as $property)
                                                                    <option value="{{ $property->id }}">{{ $property->name_property_type }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger font-danger error-text property_type_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sale_type_id">ประเภทการขาย<span class="star-req">*</span></label>
                                                            <select class="form-control" name="sale_type_id">
                                                                <option value="">เลือกประเภทการขาย</option>
                                                                @foreach ($sales_type as $sale_type)
                                                                    <option value="{{ $sale_type->id }}">{{ $sale_type->name_sale_type }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger font-danger error-text sale_type_id_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="body">เนื้อหา<span class="star-req">*</span></label>
                                                    <textarea class="form-control" name="body" id="body" rows="3" placeholder="เนื้อหา..."></textarea>
                                                    <span class="text-danger font-danger error-text body_error"></span>
                                                  </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">รูปอสังหา ค่อยมาใส่</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="image"
                                                                id="image">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}


                                        </div>
                                    </div>



                                </div>

                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary">สร้างประกาศ</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->

    <!-- create data -->
    <script>
        $(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();

                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                        // console.log('test');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            // $(form)[0].reset();


                            Swal.fire({
                                title: 'บันทึกสําเร็จ',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'OK',

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.location.href = "{!! route('posts') !!}"
                                }
                            });


                            // Swal.fire({
                            //     title: data.msg,
                            //     icon: 'success',
                            //     confirmButtonText: 'OK'

                            // }).then((result) => {

                            //     document.location.href="{!! route('users') !!}"

                            // })


                            //alert success
                            // swal.fire("สำเร็จ", data.msg, "success");

                        }

                    }
                });
            });

        });
    </script>
@endsection
