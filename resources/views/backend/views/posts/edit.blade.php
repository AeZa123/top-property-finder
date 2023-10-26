@extends('backend.layouts.app')

@section('content')
    <style>
        .star-req {
            color: red;
        }

        p {
            margin: 0;
        }

        .upload__inputfile {
            width: .1px;
            height: .1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all .3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all .3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }


        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }


        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            /* background-size: contain; */
            position: relative;
            padding-bottom: 100%;
        }


        .upload__img-box {
            position: relative;
        }

        .close-icon {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px;
            background-color: #fff;
            border-radius: 0 10px 0 0;
            cursor: pointer;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">แก้ไขประกาศ</h3>
                        </div>


                        <form id="form" method="POST" action="{{ url('post/update/' . $data->id) }}" enctype="multipart/form-data">
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
                                                        placeholder="หัวข้อ" value="{{ $data->title }}">
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
                                                                id="amount" placeholder="จำนวน"
                                                                value="{{ $data->amount }}">
                                                            <span
                                                                class="text-danger font-danger error-text amount_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price">ราคา<span
                                                                    class="star-req">*</span></label>
                                                            <input type="text" class="form-control" name="price"
                                                                id="price" placeholder="ราคา"
                                                                value="{{ $data->price }}">
                                                            <span
                                                                class="text-danger font-danger error-text price_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="property_name">ชื่ออสังหา<span
                                                            class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="property_name"
                                                        id="property_name" placeholder="ชื่ออสังหา"
                                                        value="{{ $data->property_name }}">
                                                    <span
                                                        class="text-danger font-danger error-text property_name_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="property_type_id">ประเภทอสังหา<span
                                                                    class="star-req">*</span></label>
                                                            <select class="form-control" name="property_type_id">
                                                                <option value="">เลือกประเภทอสังหา</option>
                                                                <?php echo $data_html_proper_type; ?>

                                                            </select>
                                                            <span
                                                                class="text-danger font-danger error-text property_type_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sale_type_id">ประเภทการขาย<span
                                                                    class="star-req">*</span></label>
                                                            <select class="form-control" name="sale_type_id">
                                                                <option value="">เลือกประเภทการขาย</option>
                                                                <?php echo $data_html_sales_type; ?>
                                                                {{-- @foreach ($sales_type as $sale_type)
                                                                    <option value="{{ $sale_type->id }}">
                                                                        {{ $sale_type->name_sale_type }}</option>
                                                                @endforeach --}}
                                                            </select>
                                                            <span
                                                                class="text-danger font-danger error-text sale_type_id_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="body">เนื้อหา<span class="star-req">*</span></label>
                                                    <textarea class="form-control" name="body" id="body" rows="3" placeholder="เนื้อหา..."> {{ $data->body }} </textarea>
                                                    <span class="text-danger font-danger error-text body_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="upload__box">
                                                    <div class="upload__btn-box">
                                                        <label class="upload__btn">
                                                            <p>Upload images</p>
                                                            <input type="file" name="images[]" multiple=""
                                                                data-max_length="20" class="upload__inputfile">
                                                        </label>
                                                    </div>
                                                    <div class="upload__img-wrap">
                                                        @foreach ($imagePosts as $imagePost)
                                                            <div class="upload__img-box"
                                                                id="{{ $imagePost->image_post_id }}{{ $imagePost->image_id }}">


                                                                <img data-id_image_post="{{ $imagePost->image_post_id }}"
                                                                    data-id_post="{{ $imagePost->post_id }}"
                                                                    width="200" height="200"
                                                                    style="background-image: cover; padding: 5px; border-radius: 10px;"
                                                                    src="{{ asset('storage/images/property_image/' . $imagePost->image_name) }}"
                                                                    alt="">
                                                                {{-- <div class="upload__img-close"></div> --}}
                                                                {{-- <div class="close-icon"></div> --}}
                                                                <div class="upload__img-close delete_image"
                                                                    data-image-post-id="{{ $imagePost->image_post_id }}"
                                                                    data-image-id="{{ $imagePost->image_id }}"
                                                                    data-image-name="{{ $imagePost->image_name }}"></div>


                                                            </div>
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>










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
        $(document).ready(function() {

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
                                    $(form).find('span.' + prefix + '_error')
                                        .text(val[0]);
                                });
                            } else {


                                Swal.fire({
                                    title: 'แก้ไขสำเร็จ',
                                    text: data.msg,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href =
                                            "{!! route('users') !!}"
                                    }
                                });

                            }

                        }
                    });
                });
            });


            // เมื่อคลิกที่รูปภาพ
            $(".delete_image").click(function() {
                var idImagePost = $(this).data("image-post-id");
                var imageName = $(this).data("image-name");
                var imageId = $(this).data("image-id");
                var customUrl = "{{ url('post/delete/image/') }}" + '/' + idImagePost + '/' + imageId +
                    '/' + imageName; // สร้าง URL โดยรวม idpost และ nameimage

                // var id_delete_html = '#'+idImagePost+''+imageId;

                var id_delete_html = '' + idImagePost + imageId;
               



                $.ajax({

                    url: customUrl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        // $(form).find('span.error-text').text('');
                        // console.log('test');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {

                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                icon: 'success',
                                // title: data.msg
                                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                            })
                            $('#' + id_delete_html).remove();

                            // Swal.fire({
                            //     title: 'แก้ไขสำเร็จ',
                            //     text: data.msg,
                            //     icon: 'success',
                            //     confirmButtonText: 'OK',
                            // }).then((result) => {
                            //     if (result.isConfirmed) {
                            //         document.location.href = "{!! route('users') !!}"
                            //     }
                            // });

                        }

                    }
                });






            });






            jQuery(document).ready(function() {
                ImgUpload();
            });

            function ImgUpload() {
                var imgWrap = "";
                var imgArray = [];

                $('.upload__inputfile').each(function() {
                    $(this).on('change', function(e) {
                        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                        var maxLength = $(this).attr('data-max_length');

                        var files = e.target.files;
                        var filesArr = Array.prototype.slice.call(files);
                        var iterator = 0;
                        filesArr.forEach(function(f, index) {

                            if (!f.type.match('image.*')) {
                                return;
                            }

                            if (imgArray.length > maxLength) {
                                return false
                            } else {
                                var len = 0;
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i] !== undefined) {
                                        len++;
                                    }
                                }
                                if (len > maxLength) {
                                    return false;
                                } else {
                                    imgArray.push(f);

                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        var html =
                                            "<div class='upload__img-box'><div style='border-radius: 10px; background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length +
                                            "' data-file='" + f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                        imgWrap.append(html);
                                        iterator++;
                                    }
                                    reader.readAsDataURL(f);
                                }
                            }
                        });
                    });
                });

                $('body').on('click', ".upload__img-close", function(e) {

                    if (!$(this).hasClass('delete_image')) {
                        var file = $(this).parent().data("file");
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i].name === file) {
                                imgArray.splice(i, 1);
                                break;
                            }
                        }
                        $(this).parent().parent().remove();



                    }


                });
            }








        });
    </script>
@endsection
