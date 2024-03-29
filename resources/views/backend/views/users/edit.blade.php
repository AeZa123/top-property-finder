@extends('backend.layouts.app')

@section('content')
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
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <form id="form" method="POST" action="{{ url('user/update/' . $data->id) }}"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="row">

                                            <div class="col-md-12 mt-3 mb-3">

                                                <div class="col-md-12 text-center mb-3 show-image">
                                                    <img class="rounded-circle show-image-profile" id="data_base64"
                                                        src="{{ asset('storage/images/users/' . $data->avatar) }}"
                                                        alt="รูปภาพ">
                                                    <input type="hidden" name="" id="data_base64_input">
                                                </div>
                                                <div class="text-center mb-2">
                                                    <span
                                                        class="text-danger text font-danger error-text avatar_error"></span>
                                                </div>



                                                {{-- <div class="col-md-12 text-center">
                                                    <label for="avatar" class="file-upload-button">
                                                        แก้ไขโปรไฟล์
                                                    </label>
                                                    <input type="file" name="avatar" id="avatar" accept="image/*"
                                                        class="file-input" />
                                                </div> --}}


                                                <div class="col-md-12 text-center mt-3 mb-5">
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

                                                            <div class="panel-body"></div>
                                                        </div>


                                                        <div class="btn-group">
                                                            <span class="btn btn-primary btn-file">

                                                                <i class="fas fa-folder-open"></i> เลือกโปรไฟล์ <input
                                                                    type="file" id="avatar" name="avatar"
                                                                    accept="image/*">
                                                            </span>
                                                            <button type="button" class="btn btn-success btn-crop">
                                                                <i class="fas fa-crop-alt"></i> Crop
                                                            </button>

                                                        </div>
                                                        <div class="text-center mb-2">
                                                            <span
                                                                class="text-danger text font-danger error-text avatar_error"></span>
                                                        </div>


                                                        <div class="form-group" hidden>
                                                            <textarea class="data form-control" name="" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- <div class="col-md-6 text-center">
                                                <div>
                                                    no resize
                                                    <img width="200" height="auto" src="{{ asset('storage/images/users/'. $data->avatar) }}" alt="">
                                                </div>
                                            </div> --}}


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">ชื่อ<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="fname" id="fname"
                                                        placeholder="ชื่อ" value="{{ $data->fname }}">
                                                    <span class="text-danger font-danger error-text fname_error"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lname">นามสกุล<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="lname" id="lname"
                                                        placeholder="นามสกุล" value="{{ $data->lname }}">
                                                    <span class="text-danger font-danger error-text lname_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">อีเมล<span class="star-req">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="อีเมล" value="{{ $data->email }}">
                                                    <span class="text-danger font-danger error-text email_error"></span>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">รหัสผ่าน</label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="รหัสผ่าน" >
                                                    <span class="text-danger font-danger error-text password_error"></span>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tel">เบอร์โทร<span class="star-req">*</span></label>
                                                    <input type="text" class="form-control" name="tel" id="tel"
                                                        placeholder="เบอร์โทร" value="{{ $data->tel }}">
                                                    <span class="text-danger font-danger error-text tel_error"></span>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                        id="password_confirmation" placeholder="ยืนยันรหัสผ่าน">
                                                    <span
                                                        class="text-danger font-danger error-text password_confirmation_error"></span>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>เพศ</label>
                                                    <select class="form-control" name="gender">
                                                        {{-- {{ echo $data_html_gender }} --}}
                                                        <?php echo $data_html_gender; ?>
                                                    </select>
                                                    <span class="text-danger font-danger error-text gender_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>สิทธิ์การใช้งาน<span class="star-req">*</span></label>
                                                    <select class="form-control" name="role">
                                                        <?php echo $data_html_role; ?>
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
                                <button type="submit" id="update" class="btn btn-primary">Update</button>
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






        $(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();


                var form = this;

                var srcValue = $(".img-thumbnail").attr("src");
                // แสดงค่า src ที่ดึงได้ใน console
                // console.log("Src value:", srcValue);

                // var form = document.getElementById("myAwesomeForm");
                var fd = new FormData(form);
                if(srcValue !== undefined && srcValue !== ''){
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
                    
                    fd.append("image", blob);

                }



                // var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: fd,
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
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {


                            Swal.fire({
                                title: 'แก้ไขสำเร็จ',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.location.href = "{!! route('users') !!}"
                                }
                            });

                        }

                        $('#update').prop('disabled', false);

                    }
                });
            });

        });
    </script>




    {{-- crop image new --}}
    <script>
        $('#avatar').on('change', function() {


            $('.image-cropbox').css("width", "50% !important");
            $('.image-cropbox').css("height", "auto !important");

            $(".show-image").hide();

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
