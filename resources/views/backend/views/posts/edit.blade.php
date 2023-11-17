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







        /* ซ่อน input file ด้วย opacity 0 และ position absolute */
        .file-input {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
        }

        /* สร้างสไตล์สำหรับปุ่มที่ใช้เปิดหน้าต่างการเลือกไฟล์ */
        .file-upload-button {
            background-color: #007bff;
            /* สีพื้นหลังของปุ่ม */
            color: #fff;
            /* สีข้อความ */
            padding: 10px 15px;
            /* ขนาดของปุ่ม */
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
        }

        /* สไตล์ปุ่มเมื่อนำเมาส์ hover หรือกดค้าง */
        .file-upload-button:hover,
        .file-upload-button:active {
            background-color: #0056b3;
        }




        .show-image {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
            max-width: 100%;
            height: auto;
            /* border-radius: 20px; */
        }

        .img-thumbnail {
            padding: 0.25rem !important;
            background-color: #fff !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.25rem !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .075) !important;
            max-width: 100% !important;
            height: auto !important;
            /* border-radius: 20px; */
        }
    </style>


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
    
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script> --}}


    <link href="{{ asset('cropImage/src/jquery.cropbox.css') }}" rel="stylesheet" type="text/css">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.12/jquery.mousewheel.js"></script>
    <script src="{{ asset('cropImage/src/jquery.cropbox.js') }}"></script>



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


                        <form id="form" method="POST" action="{{ url('post/update/' . $data->id) }}"
                            enctype="multipart/form-data">
                            {{-- <form id="form" method="POST" action="" enctype="multipart/form-data"> --}}
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">

                                    <input type="text" hidden value="{{ $data->id }}" id="id">



                                    {{-- <div class="col-md-12 mt-3 mb-3">

                                        <div class="col-md-12 text-center mb-3">
                                            
                                            <img class=" rounded" id="data_base64" src="{{ asset('storage/images/property_image/image_cover/' . $data->image_cover) }}" alt="รูปภาพ">
                                            <input type="hidden" name="data_base64" id="data_base64_input">
                                        </div>
                                        <div class="text-center mb-2">
                                            <span class="text-danger text font-danger error-text image_cover_error"></span>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <label for="image_cover" class="file-upload-button">
                                                เลือกรูปปกประกาศ
                                            </label>
                                            <input type="file" name="image_cover" id="image_cover"
                                                accept="image/*" class="file-input" />
                                        </div>
                                    </div> --}}









                                    <div class="col-md-6 text-center mb-5">
                                        <img class="show-image mb-2"
                                            src="{{ asset('storage/images/property_image/image_cover/' . $data->image_cover) }}"
                                            alt="รูปภาพ">
                                        <div id="plugin" class="cropbox">
                                            <div class="workarea-cropbox">
                                                <div class="bg-cropbox">
                                                    <img class="image-cropbox">
                                                    <div class="membrane-cropbox"></div>
                                                </div>
                                                <div class="frame-cropbox">
                                                    <div class="resize-cropbox"></div>
                                                </div>
                                            </div>

                                            <div class="cropped panel panel-default">
                                                {{-- <div class="panel-heading">
                                                    <h3 class="panel-title">Result of cropping</h3>
                                                </div> --}}
                                                <div class="panel-body"></div>
                                            </div>


                                            <div class="btn-group">
                                                <span class="btn btn-primary btn-file">

                                                    <i class="fas fa-folder-open"></i> เลือกภาพหน้าปก <input type="file"
                                                        id="image_cover" name="image_cover" accept="image/*">
                                                </span>
                                                <button type="button" class="btn btn-success btn-crop">
                                                    <i class="fas fa-crop-alt"></i>Crop
                                                </button>
                                                {{-- <button type="button" class="btn btn-warning btn-reset">
                                                    <i class="glyphicon glyphicon-repeat"></i> Reset
                                                </button> --}}
                                            </div>
                                            <div class="text-center mb-2">
                                                <span
                                                    class="text-danger text font-danger error-text image_cover_error"></span>
                                            </div>


                                            <div class="form-group" hidden>
                                                <textarea class="data form-control" name="" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>











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
                                                            </select>
                                                            <span
                                                                class="text-danger font-danger error-text sale_type_id_error"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="bedroom">จำนวนห้องนอน<span
                                                                    class="star-req">*</span></label>
                                                            <input type="text" class="form-control" name="bedroom"
                                                                id="bedroom" placeholder="จำนวนห้องนอน"
                                                                value="{{ $data->bedroom }}">
                                                            <span
                                                                class="text-danger font-danger error-text bedroom_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="bathroom">จำนวนห้องน้ำ<span
                                                                    class="star-req">*</span></label>
                                                            <input type="text" class="form-control" name="bathroom"
                                                                id="bathroom" placeholder="จำนวนห้องน้ำ"
                                                                value="{{ $data->bathroom }}">
                                                            <span
                                                                class="text-danger font-danger error-text bathroom_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="area">พื้นที่ ตร.ม<span
                                                                    class="star-req">*</span></label>
                                                            <input type="text" class="form-control" name="area"
                                                                id="area" placeholder="พื้นที่ ตร.ม"
                                                                value="{{ $data->area }}">
                                                            <span
                                                                class="text-danger font-danger error-text area_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_start_rent">วันที่พร้อมให้เช่า</label>
                                                            <input type="date" class="form-control"
                                                                name="date_start_rent" id="date_start_rent"
                                                                value="{{ $data->date_start_rent }}">
                                                            <span
                                                                class="text-danger font-danger error-text date_start_rent_error"></span>
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

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="thai_provinces_id">จังหวัด<span
                                                            class="star-req">*</span></label>
                                                    <select class="form-control" name="thai_provinces_id">
                                                        <option value="">เลือกจังหวัด</option>
                                                        <?php echo $data_html_thai_provinces; ?>
                                                    </select>
                                                    <span
                                                        class="text-danger font-danger error-text thai_provinces_id_error"></span>
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
                                <button type="submit" id="update" class="btn btn-primary">แก้ไขประกาศ</button>
                            </div>
                        </form>




                    </div>
                    <!-- /.card -->


                </div>
            </div>
        </div>


        {{-- modal --}}
        <div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-left">จัดรูปปกประกาศ</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                {{-- <div id="image_demo" style="width:350px; margin-top:30px"></div> --}}
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3 img-fluid" id="image_demo"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="col-md-4" style="padding-top:30px;">
                                <br />
                                <br />
                                <br />
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success crop_image">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <!-- /.content -->

    <!-- create data -->
    <script>
        function b64toBlob(b64Data, contentType, sliceSize) {
            contentType = contentType || '';
            sliceSize = sliceSize || 512;

            var byteCharacters = atob(b64Data);
            var byteArrays = [];

            for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                var slice = byteCharacters.slice(offset, offset + sliceSize);

                var byteNumbers = new Array(slice.length);
                for (var i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }

                var byteArray = new Uint8Array(byteNumbers);

                byteArrays.push(byteArray);
            }

            var blob = new Blob(byteArrays, {
                type: contentType
            });
            return blob;
        }









        $(document).ready(function() {

            $(function() {
                $('#form').on('submit', function(e) {
                    e.preventDefault();

                    var id = $('#id').val();
                    var form = this;

                    var srcValue = $(".img-thumbnail").attr("src");
                    // แสดงค่า src ที่ดึงได้ใน console
                    // console.log("Src value:", srcValue);

                    // var form = document.getElementById("myAwesomeForm");

                    // var ImageURL = "data:image/gif;base64,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";
                    var ImageURL = srcValue;
                    // Split the base64 string in data and contentType
                    var block = ImageURL.split(";");
                    // Get the content type
                    var contentType = block[0].split(":")[1];// In this case "image/gif"
                    // get the real base64 content of the file
                    var realData = block[1].split(",")[1];// In this case "iVBORw0KGg...."

                    // Convert to blob
                    var blob = b64toBlob(realData, contentType);

                    // Create a FormData and append the file
                    var fd = new FormData(form);
                    fd.append("image", blob);

                    var imageData = fd.get("image");
                    console.log(imageData);


























                    // var url = 'post/update/' + id;

                    // var form = this;
                    $.ajax({
                        url: '{{ url('/post/update/') }}' + '/' + id,
                        // url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: fd,
                        // data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $('#update').prop('disabled', true);
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
                                            "{!! route('posts') !!}"
                                    }
                                });

                            }
                            $('#update').prop('disabled', false);

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
                                title: '<div class="mt-2 ml-2 text-success">ลบรูปภาพเรียบร้อยแล้ว!!</div>'
                            })
                            $('#' + id_delete_html).remove();


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









    {{-- crop image new --}}
    <script>
        $('#image_cover').on('change', function() {


            $('.image-cropbox').css("width", "50% !important");
            $('.image-cropbox').css("height", "auto !important");
            // $('.img-thumbnail').css("border-radius", "20px !important");

            $('.show-image').hide();



            
            
            
            
        });
        
        
        $('.btn-crop').on('click', function() {
            


            // var srcValue = $(".img-thumbnail").attr("src");
            // // แสดงค่า src ที่ดึงได้ใน console
            // console.log("Src value:", srcValue);


            setTimeout(function() {
                // เลือก element ที่มี class เป็น "img-thumbnail" และดึงค่า src
                var srcValue = $(".img-thumbnail").attr("src");
                // แสดงค่า src ที่ดึงได้ใน console
                console.log("Src value:", srcValue);
            }, 1500);




        })





        $('#plugin').cropbox({
            selectors: {
                inputInfo: '#plugin textarea.data',
                inputFile: '#plugin input[type="file"]',
                btnCrop: '#plugin .btn-crop',
                btnReset: '#plugin .btn-reset',
                resultContainer: '#plugin .cropped .panel-body',
                messageBlock: '#message'
            },
            imageOptions: {
                class: 'img-thumbnail',
                style: 'margin-right: 5px; margin-bottom: 5px'
            },
            variants: [{
                    width: 600,
                    height: 400,
                    minWidth: 600,
                    minHeight: 400,
                    maxWidth: 600,
                    maxHeight: 400
                },
                // {
                //     width: 600,
                //     height: 400
                // }
            ],
            messages: [
                'Crop a middle image.',
                // 'Crop a small image.'
            ]
        });
    </script>
@endsection
