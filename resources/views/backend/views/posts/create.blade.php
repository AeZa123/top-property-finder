@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->

    <style>
        .star-req {
            color: red;
        }

        /* html * {
                                box-sizing: border-box;
                            } */

        p {
            margin: 0;
        }

        /* .upload__box {
                                padding: 40px;
                            } */

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









        div.cropbox .btn-file {
            position: relative;
            overflow: hidden;
        }

        div.cropbox .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        div.cropbox .cropped {
            margin-top: 10px;
        }

        .syntaxhighlighter table .container:before {
            display: none !important;
        }

        footer {
            margin-top: 10px;
            border-top: #cdcdcd 1px solid;
        }
    </style>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script> --}}



    <link href="{{ asset('cropImage/src/jquery.cropbox.css') }}" rel="stylesheet" type="text/css">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.12/jquery.mousewheel.js"></script>
    <script src="{{ asset('cropImage/src/jquery.cropbox.js') }}"></script>



    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">สร้างปรกาศ</h3>
                        </div>

                        <form id="form" method="POST" action="{{ route('post.storage') }}"
                            enctype="multipart/form-data">
                            {{-- <form id="form" method="POST" action="" enctype="multipart/form-data"> --}}
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">


                                    {{-- 
                                    <div class="col-md-12 mt-3 mb-3">

                                        <div class="col-md-12 text-center mb-3">

                                            <img class="img-fluid rounded" id="data_base64" src="" alt="รูปภาพ">
                                            <input type="hidden" name="data_base64" id="data_base64_input">
                                        </div>
                                        <div class="text-center mb-2">
                                            <span class="text-danger text font-danger error-text image_cover_error"></span>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <label for="image_cover" class="file-upload-button">
                                                เลือกรูปปกประกาศ
                                            </label>
                                            <input type="file" name="image_cover" id="image_cover" accept="image/*"
                                                class="file-input" />
                                        </div>
                                    </div> --}}






                                    <div class="col-md-6 text-center mb-5">
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
                                                    <i class="fas fa-crop-alt"></i> Crop
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
                                                <textarea class="data form-control" name="data_base64" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input type="hidden" name="data_base64" id="data_base64_input"> --}}

























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
                                                    <label for="property_name">ชื่ออสังหา<span
                                                            class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="property_name"
                                                        id="property_name" placeholder="ชื่ออสังหา">
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
                                                                @foreach ($property_type as $property)
                                                                    <option value="{{ $property->id }}">
                                                                        {{ $property->name_property_type }}</option>
                                                                @endforeach
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
                                                                @foreach ($sales_type as $sale_type)
                                                                    <option value="{{ $sale_type->id }}">
                                                                        {{ $sale_type->name_sale_type }}</option>
                                                                @endforeach
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
                                                    <textarea class="form-control" name="body" id="body" rows="3" placeholder="เนื้อหา..."></textarea>
                                                    <span class="text-danger font-danger error-text body_error"></span>
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <div class="upload__box">
                                                    <div class="upload__btn-box">
                                                        <label class="upload__btn">
                                                            <p>Upload images</p>
                                                            <input id="images-file-input" type="file" name="images[]" multiple data-max_length="20" class="upload__inputfile">
                                                            {{-- <input id="images-file-input" type="file" name="images[]" multiple data-max_length="20" class="upload__inputfile"> --}}
                                                        </label>
                                                    </div>
                                                    <div class="upload__img-wrap"></div>
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

                            <div id="selected-file-names"></div>

                            <div class="text-center mb-3">
                                <button type="submit" id="create" class="btn btn-primary">สร้างประกาศ</button>
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

        var imgArray = [];



        $(function() {


           
            $('#form').on('submit', function(e) {
                e.preventDefault();

                var form = this;
                var form_data = new FormData(form)

                // var formData = new FormData();
                var files = $('#images-file-input')[0].files; // รับรายการไฟล์ที่เลือก

                // console.log(files);
                // console.log(imgArray);

                // เพิ่มไฟล์ใน FormData
                for (var i = 0; i < imgArray.length; i++) {

                    form_data.append('images[]', imgArray[i]);

                }

                // console.log(test)



                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: form_data,
                    // data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $('#create').prop('disabled', true);
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



                        }

                        $('#create').prop('disabled', false);

                    }
                });
            });

        });


        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            // var imgArray = [];

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
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });

                    // $('#images-file-input').val(imgArray);
                    // $('#images-file-input').val(JSON.stringify(imgArray)); // แปลงเป็น JSON เพื่อเก็บใน input
                    // $('#images-file-input').val(imgArray.join(', '));



                    // var formData = new FormData();
                    // var files = $('#images-file-input')[0].files; // รับรายการไฟล์ที่เลือก

                    // // เพิ่มไฟล์ใน FormData
                    // for (var i = 0; i < files.length; i++) {
                    //     formData.append('images[]', files[i]);
                    // }

                    // console.log(formData);





                     // แสดงชื่อไฟล์ที่เลือกบนหน้าเว็บ
                    // var fileNames = imgArray.map(function(file) {
                    //     return file.name;
                    // });
                    // $('#selected-file-names').text(fileNames.join(', '));
                    console.log(imgArray);
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>




    {{-- crop image new --}}
    <script>
        $('#image_cover').on('change', function() {


            $('.image-cropbox').css("width", "50% !important");
            $('.image-cropbox').css("height", "auto !important");

            console.log('test');

            // $('.image-cropbox').attr("width", "50%!important");
            // $('.image-cropbox').attr("height", "auto!important");

        });





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
