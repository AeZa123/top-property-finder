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
    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
   
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
   
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



                                                <div class="col-md-12 text-center mb-3">
                                                    <img class="rounded-circle" id="data_base64"
                                                        src="{{ asset('storage/images/users/' . $data->avatar) }}"
                                                        alt="รูปภาพ">
                                                    <input type="hidden" name="data_base64" id="data_base64_input">
                                                </div>
                                                <div class="text-center mb-2">
                                                    <span
                                                        class="text-danger text font-danger error-text avatar_error"></span>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <label for="avatar" class="file-upload-button">
                                                        แก้ไขโปรไฟล์
                                                    </label>
                                                    <input type="file" name="avatar" id="avatar" accept="image/*"
                                                        class="file-input" />
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
                                <button type="submit" class="btn btn-primary">Update</button>
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

                    }
                });
            });

        });











        // image


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

                console.log(response);

                $("#data_base64").attr("src", response);
                $("#data_base64_input").val(response);
                $('#imageModel').modal('hide');

                // $.ajax({
                //     url: "{{ url('user/testimage') }}",
                //     type: 'POST',
                //     data: {
                //         '_token': $('meta[name="csrf-token"]').attr('content'),
                //         'image': response
                //     },
                //     success: function(data) {
                //         $('#imageModel').modal('hide');
                //         alert('Crop image has been uploaded');
                //     }
                // })
            });
        });








    </script>
@endsection
