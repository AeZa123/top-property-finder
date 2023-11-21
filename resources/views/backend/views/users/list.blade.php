@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Users</h3>
                            <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right">Create user</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="search-box float-right" style="margin-top: -3px;">
                                {{-- <form action="#">
                                    <input style="width: 350px; height: 35px;" class="form-control" type="text"
                                        id="searcaah" name="searcaah" placeholder="Search..." required>
                                    <i class="ti-search"></i>
                                </form> --}}
                            </div>
                            <table id="example1" class="table table-hover table-bordered table-striped">
                                <thead class="text-white text-center" style="background-color: #00B98E;">
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>อีเมล</th>
                                        <th>เบอร์โทร</th>
                                        <th>status</th>
                                        <th>created at</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <a href="#">
                                                    <div class="user-panel d-flex align-items-center">
                                                        @if ($user->avatar != null)
                                                            <div>
                                                                <img src="{{ asset('storage/images/users/' . $user->avatar) }}"
                                                                    class="img-circle " alt="User Image">
                                                            </div>
                                                        @else
                                                            <div>
                                                                <img src="{{ asset('storage/images/users/653d4e8e1a4e0.png') }}"
                                                                    class="img-circle " alt="User Image">
                                                            </div>
                                                        @endif
                                                        <div class="ml-2">
                                                            {{ $user->fname }} {{ $user->lname }}
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->tel }}</td>
                                            <td>
                                                <?php
                                                if ($user->role == 1) {
                                                    $code_color_text = '#e11d48';
                                                    $code_color_bg = '#ffe4e6';
                                                } elseif ($user->role == 2) {
                                                    $code_color_text = '#ea580c';
                                                    $code_color_bg = '#ffedd5';
                                                } elseif ($user->role == 3) {
                                                    $code_color_text = '#0891b2';
                                                    $code_color_bg = '#cffafe';
                                                }
                                                
                                                ?>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-12 text-center">
                                                        <div class=""
                                                            style="border-radius: 12px; background-color: {{ $code_color_bg }}; color:{{ $code_color_text }};">
                                                            <b>{{ $user->role_name }}</b>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>

                                            <td>
                                                <a href="{{ url('user/edit/' . $user->id) }}">
                                                    <i class="fas fa-edit btn btn-warning"></i>
                                                </a>
                                                <a href="#" data-id="{{ $user->id }}" id="deleteBtn">
                                                    <i class="fas fa-trash-alt btn btn-danger text-white"></i>
                                                </a>
                                            </td>
                                           

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                            <div style="float: right">
                                {{ $users->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>



                {{-- <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Manage Users</h3>
                            <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right">Create user</a>
                        </div>


                        <div class="card-body">
                            <h5 class="header-title mt-2" style="float: left">รายชื่อผู้ใช้งานทั้งหมด</h5>
                            <div class="search-box float-right" style="margin-top: -3px;">
                                <form action="#">
                                    <input style="width: 380px; height: 35px;" class="form-control" type="text"
                                        id="search" name="search" placeholder="Search..." required>
                                    <i class="ti-search"></i>
                                </form>
                            </div>

                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead class="text-uppercase bg-danger">
                                            <tr class="text-white">
                                                <th scope="col">ID</th>
                                                <th class="text-center" scope="col">ชื่อ-นามสกุล</th>
                                                <th scope="col">อีเมล</th>
                                                <th scope="col">เบอร์โทร</th>
                                                <th scope="col">status</th>
                                                <th scope="col">created at</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->id }}</th>
                                                    <td>
                                                        <a href="#">


                                                            <div
                                                                class="user-panel d-flex align-items-center justify-content-center text-center">
                                                                @if ($user->avatar != null)
                                                                    <div>
                                                                        <img src="{{ asset('storage/images/users/' . $user->avatar) }}"
                                                                            class="img-circle " alt="User Image">
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <img src="{{ asset('storage/images/users/653d4e8e1a4e0.png') }}"
                                                                            class="img-circle " alt="User Image">
                                                                    </div>
                                                                @endif
                                                                <div class="ml-2">
                                                                    {{ $user->fname }} {{ $user->lname }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->tel }}</td>
                                                    <td>
                                                        <?php
                                                        if ($user->role == 1) {
                                                            $code_color_text = '#e11d48';
                                                            $code_color_bg = '#ffe4e6';
                                                        } elseif ($user->role == 2) {
                                                            $code_color_text = '#ea580c';
                                                            $code_color_bg = '#ffedd5';
                                                        } elseif ($user->role == 3) {
                                                            $code_color_text = '#0891b2';
                                                            $code_color_bg = '#cffafe';
                                                        }
                                                        
                                                        ?>

                                                        <div class="row justify-content-center">
                                                            <div class="col-md-12 text-center">
                                                                <div class=""
                                                                    style="border-radius: 12px; background-color: {{ $code_color_bg }}; color:{{ $code_color_text }};">
                                                                    <b>{{ $user->role_name }}</b>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('user/edit/' . $user->id) }}">
                                                            <i class="fas fa-edit btn btn-warning"></i>
                                                        </a>
                                                        <a href="#" data-id="{{ $user->id }}" id="deleteBtn">
                                                            <i class="fas fa-trash-alt btn btn-danger text-white"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="float: right">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>


                </div> --}}



            </div>
        </div>


    </section>
    <!-- /.content -->



    <script type="text/javascript">
        var delayTimer;
        $('#search').on('keyup', function() {
            $value = $(this).val();
            // กำหนดเวลาหน่วง (เช่น 1000 มิลลิวินาทีหรือ 1 วินาที)
            var delay = 1000;
            // ถ้ามีการกระทำก่อนหน้านี้ (การพิมพ์เพื่อค้นหา) ยกเลิกการหน่วงเวลาเดิม
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('users/search') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('tbody').html(data);
                        // console.log(data);
                    }
                });
            }, delay);
        })





        //--------------------------
        // delete data
        //--------------------------
        $(document).on('click', '#deleteBtn', function() {
            var id = $(this).data('id');
            var url = '{{ URL::to('user/destroy') }}';


            Swal.fire({
                title: 'ลบข้อมูล',
                text: "ต้องการลบข้อมูลนี้หรือไม่!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 1) {

                                Swal.fire({
                                    title: 'ลบข้อมูลสำเร็จ',
                                    text: data.msg,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href =
                                            "{!! route('users') !!}"
                                    }
                                });


                            } else {

                                Swal.fire(
                                    'ไม่สำเร็จ',
                                    data.msg,
                                    'error'
                                )

                            }
                        }
                    })
                }

            })

        })
    </script>
@endsection
