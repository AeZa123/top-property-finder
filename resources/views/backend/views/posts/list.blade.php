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
                            <h3 class="card-title">จัดการประกาศ</h3>
                            <a href="{{ route('post.create') }}" class="btn btn-success btn-sm float-right">สร้างประกาศ</a>
                        </div>


                        <div class="card-body">
                            <h5 class="header-title mt-2" style="float: left">รายชื่อประกาศทั้งหมด</h5>
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
                                                <th scope="col">ชื่ออสังหา</th>
                                                <th scope="col">หัวข้อประกาศ</th>
                                                <th scope="col">ราคา</th>
                                                <th scope="col">จำนวน</th>
                                                <th scope="col">เจ้าของประกาศ</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <th scope="row">{{ $data->id }}</th>
                                                    {{-- <td><a href="{{url('showBlog/'.$user->id)}}" target="_bank">Test </a></td> --}}
                                                    <td>{{ $data->property_name }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->price }}</td>
                                                    <td>{{ $data->amount }}</td>
                                                    <td>{{ $data->fname }} {{ $data->lname }}</td>
                                                   
                                                    <td>
                                                        {{-- <a href="{{url('blog/laravel/edit/'.$blog->id)}}">
                                                            <i class="ti-pencil-alt pr-3 text-warning" title="Edit"></i>
                                                        </a> --}}

                                                        <a href="{{ url('post/edit/' . $data->id) }}">
                                                            <i class="fas fa-edit btn btn-warning"></i>
                                                        </a>
                                                        <a href="#" data-id="{{ $data->id }}" id="deleteBtn">
                                                            <i class="fas fa-trash-alt btn btn-danger text-white"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- <a class="display-6" href="{{url('showBlog/'.$blog->id)}}" target="_bank">{{$blog->title}}</a> --}}



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="float: right">
                                {{ $datas->links() }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->

    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
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
        })





        //--------------------------
        // delete data
        //--------------------------
        $(document).on('click', '#deleteBtn', function() {
            var id = $(this).data('id');
            var url = '{{ route('user.destroy') }}';


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
                                            "{!! route('posts') !!}"
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
