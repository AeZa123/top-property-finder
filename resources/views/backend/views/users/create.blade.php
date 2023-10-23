@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->

    <style>
        .star-req{
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
                            <h3 class="card-title">Create User</h3>
                        </div>

                        <form id="form" method="POST" action="{{ route('user.storage') }}" enctype="multipart/form-data">
                            {{-- <form id="form" method="POST" action="" enctype="multipart/form-data"> --}}
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">
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
                                                    <label for="password_confirmation">ยืนยันรหัสผ่าน<span class="star-req">*</span></label>
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                        id="password_confirmation" placeholder="ยืนยันรหัสผ่าน">
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
                                                            <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
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
                                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger font-danger error-text role_error"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
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
                                            </div>


                                        </div>
                                    </div>



                                </div>

                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary">Create</button>
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
                                    document.location.href="{!! route('users') !!}"
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
