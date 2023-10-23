@extends('backend.layouts.app')

@section('content')
    <style>
        .star-req {
            color: red;
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
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <form id="form" method="POST" action="{{ url('user/update/' . $data->id) }}"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="row">

                                            <div class="col-md-6 text-center">
                                                <div>
                                                    no resize
                                                    <img width="200" height="auto" src="{{ asset('storage/images/users/'. $data->avatar) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <div>
                                                    resize
                                                    <img width="200" height="auto" src="{{ asset('storage/images/users/thumbnails/'. $data->avatar) }}" alt="">
                                                </div>
                                            </div>
                                         
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
    </script>
@endsection
