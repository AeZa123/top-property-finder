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

                    
                        <div class="card-body">
                            <h5 class="header-title mt-2" style="float: left">รายชื่อผู้ใช้งานทั้งหมด</h5>
                            <div class="search-box float-right" style="margin-top: -3px;">
                                <form action="#">
                                    <input style="width: 380px; height: 35px;" class="form-control" type="text" id="search" name="search" placeholder="Search..." required>
                                    <i class="ti-search"></i>
                                </form>
                            </div>
                           
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead class="text-uppercase bg-danger">
                                            <tr class="text-white">
                                                <th scope="col">ID</th>
                                                <th scope="col">ชื่อ-นามสกุล</th>
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
                                                    <th scope="row">{{$user->id}}</th>
                                                    {{-- <td><a href="{{url('showBlog/'.$user->id)}}" target="_bank">Test </a></td> --}}
                                                    <td>{{$user->fname}} {{$user->lname}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->tel}}</td>
                                                    <td>{{$user->role}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')  }}</td>
                                                    <td>
                                                        {{-- <a href="{{url('blog/laravel/edit/'.$blog->id)}}">
                                                            <i class="ti-pencil-alt pr-3 text-warning" title="Edit"></i>
                                                        </a> --}}
                                                       
                                                            <a href="{{ url('user/edit/'.$user->id)}}">
                                                            {{-- <a href="#"> --}}
                                                                <i class="btn btn-warning ti-pencil-alt pr-3 text-dark" title="Edit">Edit</i>
                                                            </a>
                                                            {{-- <a href="#" data-id="{{ $blog->id }}" id="deleteBtn">
                                                                <i class="ti-trash text-danger" title="Delete"></i>
                                                            </a> --}}
                                                            
                                                            {{-- <button  data-id="{{ $blog->id }}" class="btn btn-danger btn-sm bg-white border-0">
                                                                <i class="ti-trash text-danger" title="Delete"></i>
                                                            </button> --}}
                                                        
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                            {{-- <a class="display-6" href="{{url('showBlog/'.$blog->id)}}" target="_bank">{{$blog->title}}</a> --}}
                                            
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="float: right">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

        
    </section>
    <!-- /.content -->

    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('users/search')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                    // console.log(data);
                }
            });
        })

        // Swal.fire({
        //             title: 'ลบข้อมูล',
        //             text: "ต้องการลบข้อมูลนี้หรือไม่!",
        //             icon: 'question',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'ตกลง',
        //             cancelButtonText: 'ยกเลิก'
        //         })
        
        
    </script>



   
@endsection


