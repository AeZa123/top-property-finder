@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->

    <style>
        .star-req {
            color: red;
        }

        #image_demo {
            max-width: 100%;
            /* ขอบเขตความกว้างไม่เกิน 100% ของพื้นที่ที่บอกแบบสัมพันธ์ */
            max-height: 100%;
            /* ขอบเขตความสูงไม่เกิน 100% ของพื้นที่ที่บอกแบบสัมพันธ์ */
            width: auto;
            /* การปรับขนาดให้ตรงกับขอบเขตความกว้าง */
            height: auto;
            /* การปรับขนาดให้ตรงกับขอบเขตความสูง */
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



        .show-image-profile {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
            max-width: 100%;
            height: auto;
            /* border-radius: 20px; */
        }
    </style>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
   --}}

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
                            <h3 class="card-title">Create User</h3>
                        </div>

                        <form id="form" method="POST" action="{{ route('user.storage') }}"
                            enctype="multipart/form-data">
                            {{-- <form id="form" method="POST" action="" enctype="multipart/form-data"> --}}
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">

                                    {{-- <div class="col-md-12 mt-3 mb-3">

                                        <div class="col-md-12 text-center mb-3">
                                            <img class="rounded-circle" id="data_base64" src="" alt="รูปภาพ">
                                            <input type="hidden" name="data_base64" id="data_base64_input">
                                        </div>
                                        <div class="text-center mb-2">
                                            <span class="text-danger text font-danger error-text avatar_error"></span>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <label for="avatar" class="file-upload-button">
                                                เลือกโปรไฟล์
                                            </label>
                                            <input type="file" name="avatar" id="avatar"
                                                accept="image/*" class="file-input" />
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

                                                    <i class="fas fa-folder-open"></i> เลือกโปรไฟล์ <input type="file"
                                                        id="avatar" name="avatar" accept="image/*">
                                                </span>
                                                <button type="button" class="btn btn-success btn-crop">
                                                    <i class="fas fa-crop-alt"></i> Crop
                                                </button>
                                                {{-- <button type="button" class="btn btn-warning btn-reset">
                                                    <i class="glyphicon glyphicon-repeat"></i> Reset
                                                </button> --}}
                                            </div>
                                            <div class="text-center mb-2">
                                                <span class="text-danger text font-danger error-text avatar_error"></span>
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
                                                    <label for="fname">ชื่อ <span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="fname" id="fname"
                                                        placeholder="ชื่อ">
                                                    <span class="text-danger font-danger error-text fname_error"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lname">นามสกุล<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="lname" id="lname"
                                                        placeholder="นามสกุล">
                                                    <span class="text-danger font-danger error-text lname_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">อีเมล<span class="star-req">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="อีเมล">
                                                    <span class="text-danger font-danger error-text email_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">รหัสผ่าน<span class="star-req">*</span></label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="รหัสผ่าน">
                                                    <span class="text-danger font-danger error-text password_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tel">เบอร์โทร<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="tel" id="tel"
                                                        placeholder="เบอร์โทร">
                                                    <span class="text-danger font-danger error-text tel_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation">ยืนยันรหัสผ่าน<span
                                                            class="star-req">*</span></label>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" id="password_confirmation"
                                                        placeholder="ยืนยันรหัสผ่าน">
                                                    <span
                                                        class="text-danger font-danger error-text password_confirmation_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>เพศ</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="">เลือกเพศ</option>
                                                        @foreach ($genders as $gender)
                                                            <option value="{{ $gender->id }}">{{ $gender->gender_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    <span class="text-danger font-danger error-text gender_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>สิทธิ์การใช้งาน<span class="star-req">*</span></label>
                                                    <select class="form-control" name="role">
                                                        <option value="">เลือกสิทธิ์การใช้งาน</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->role_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger font-danger error-text role_error"></span>
                                                </div>
                                            </div>


                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="avatar">รูปโปรไฟล์</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="avatar"
                                                                id="avatar">
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
                                <button type="submit" id="create" class="btn btn-success">Create</button>
                            </div>
                    </div>


                    </form>
                </div>
                <!-- /.card -->


            </div>
        </div>
        </div>





        {{-- modal --}}
        <div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-left">จัดรูปโปรไฟล์</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                {{-- <div id="image_demo" style="width:350px; margin-top:30px"></div> --}}
                                <div class="mb-3" id="image_demo"></div>

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











        // alert('test');
        $(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();


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
                var contentType = block[0].split(":")[1]; // In this case "image/gif"
                // get the real base64 content of the file
                var realData = block[1].split(",")[1]; // In this case "iVBORw0KGg...."

                // Convert to blob
                var blob = b64toBlob(realData, contentType);

                // Create a FormData and append the file
                var fd = new FormData(form);
                fd.append("image", blob);

                // var imageData = fd.get("image");
                // console.log(imageData);

                // var form = this;
                $.ajax({
                    url: '{{ URL::to('user/storage') }}',
                    // url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: fd,
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
                                    document.location.href = "{!! route('users') !!}"
                                }
                            });


                        }
                        $('#create').prop('disabled', false);

                    }
                });
            });

        });







        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 180,
                height: 180,
                type: 'square' //circle
            },
            // boundary: {
            //     width: 300,
            //     height: 300
            // }
        });

        // เรียกฟังก์ชัน resizeCroppie เมื่อหน้าจอโหลดหรือเปลี่ยนขนาด
        $(document).ready(function() {
            resizeCroppie();
            $(window).resize(function() {
                resizeCroppie();
            });
        });

        // ฟังก์ชันสําหรับปรับขนาด Croppie container
        function resizeCroppie() {
            var screenWidth = $(window).width();
            var screenHeight = $(window).height();

            var newCroppieWidth = screenWidth < 300 ? screenWidth : 300;
            var newCroppieHeight = screenHeight < 300 ? screenHeight : 300;

            // ปรับขนาดของ Croppie container
            $('#image_demo').css({
                'width': newCroppieWidth + 'px',
                'height': newCroppieHeight + 'px'
            });
        }

        $('#avatar').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);

            $('#imageModel').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {

                $("#data_base64").attr("src", response);
                $("#data_base64_input").val(response);
                $('#imageModel').modal('hide');

            });
        });
      
    </script>

    {{-- crop image new --}}
    <script>
        $('#avatar').on('change', function() {


            $('.image-cropbox').css("width", "50% !important");
            $('.image-cropbox').css("height", "auto !important");

            // console.log('test');

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
                class: 'img-thumbnail rounded-circle',
                style: 'margin-right: 5px; margin-bottom: 5px'
            },
            variants: [{
                    width: 300,
                    height: 300,
                    minWidth: 300,
                    minHeight: 300,
                    maxWidth: 300,
                    maxHeight: 300
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
