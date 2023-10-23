<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        
        $users = DB::table('users')->select('*')->paginate(10);
        return view('backend.views.users.list', compact('users'));

    }




    public function create(){

        $genders = DB::table('genders')->select('*')->where('status', 'open')->get();
        $roles = DB::table('roles')->select('*')->where('status', 'open')->get();

        return view('backend.views.users.create', compact('genders','roles'));

    }

    public function edit($id){

        $data = User::find($id);
        $genders = DB::table('genders')->select('*')->where('status', 'open')->get();
        $roles = DB::table('roles')->select('*')->where('status', 'open')->get();

        $genders_count = count($genders);
        $roles_count = count($roles);

        $data_html_gender = '';
        for($i=0; $i<$genders_count; $i++){
           $data_html_gender .= '<option value="'.$genders[$i]->id.'"';
           $data_html_gender .= ($data->gender == $genders[$i]->id) ? 'selected' : '';
           $data_html_gender .= '>'.$genders[$i]->gender_name.'</option>';
        }

        $data_html_role = '';
        for($i=0; $i<$roles_count; $i++){
           $data_html_role .= '<option value="'.$roles[$i]->id.'"';
           $data_html_role .= ($data->role == $roles[$i]->id) ? 'selected' : '';
           $data_html_role .= '>'.$roles[$i]->role_name.'</option>';


        }

        // $data_html_role = str_replace('"', '', $data_html_role);
        // $data_html_role = trim($data_html_role, '"');

        // ทำการแสดงผล
        // echo $data_html_role;

        // dd($data_html_role);



        

        return view('backend.views.users.edit', compact('data', 'data_html_gender', 'data_html_role'));
    }


    public function storage(Request $request){

        $validator = \Validator::make($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'tel' => 'required|string|min:10|max:10',
        ],
        [
            'fname.required'=>'กรุณาระบุชื่อ',
            'lname.required'=>'กรุณาระบุนามสกุล',
            'email.required'=>'กรุณาระบุอีเมล',
            'email.unique'=>'อีเมลนี้ถูกใช้งานแล้ว',
            'email.email'=>'กรุณาใส่อีเมลให้ถูกต้อง',
            'password.required'=>'กรุณาระบุรหัสผ่าน',
            'password.min'=>'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
            'password.confirmed'=>'รหัสผ่านไม่ตรงกัน',
            'role.required'=>'กรุณาระบุประเภทผู้ใช้งาน',
            'tel.required'=>'กรุณาระบุเบอร์โทรศัพท์',
            'tel.min'=>'เบอร์โทรศัพท์ต้องมี 10 หลัก',
            'tel.max'=>'เบอร์โทรศัพท์ต้องมี 10 หลัก',
           
        ]);

        //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);

        }

        $data = array(
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'tel' => $request->tel,
            'gender' => isset($request->gender) ? $request->gender : null,
        );

        // DB::table('blogs')->insert($data);
        User::create($data);
        // return redirect('table/laravel');
        return response()->json(['code'=>1,'msg'=>'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);


    }



    public function update(Request $request, $id){


        $validator = \Validator::make($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            // 'email' => 'required|string|email|unique:users',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($id),
            ],
           
            'role' => 'required|string',
            'tel' => 'required|string|min:10|max:10',
        ],
        [
            'fname.required'=>'กรุณาระบุชื่อ',
            'lname.required'=>'กรุณาระบุนามสกุล',
            'email.required'=>'กรุณาระบุอีเมล',
            'email.unique'=>'อีเมลนี้ถูกใช้งานแล้ว',
            'email.email'=>'กรุณาใส่อีเมลให้ถูกต้อง',
            'password.confirmed'=>'รหัสผ่านไม่ตรงกัน',
            'role.required'=>'กรุณาระบุประเภทผู้ใช้งาน',
            'tel.required'=>'กรุณาระบุเบอร์โทรศัพท์',
            'tel.min'=>'เบอร์โทรศัพท์ต้องมี 10 หลัก',
            'tel.max'=>'เบอร์โทรศัพท์ต้องมี 10 หลัก',
        ]);

         //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
         if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);

        }

        $data = array(
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'role' => $request->role,
            'tel' => $request->tel,
            'gender' => isset($request->gender) ? $request->gender : null,
        );

   

        $updated = User::where('id',$id)->update($data);

        return response()->json(['code'=>1,'msg'=>'ได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว']);


    }




    public function destroy(Request $request){

        $data = User::where('id',$request->id)->delete();
        if($data){
            return response()->json(['code'=>1,'msg'=>'ได้ทำการลบข้อมูลเรียบร้อยแล้ว']);
        }else{
            return response()->json(['code'=>0,'msg'=>'ลบข้อมูลไม่สำเร็จ']);
        }
        
    }


















    public function search(Request $request)
    {

        // dd($request->show);
        // return $request->show;
        if($request->ajax())
        {
            $output="";
            $users = DB::table('users')->where('fname','LIKE','%'.$request->search."%")->select('*')->paginate(15);
            
            // return $blogs;
            if($users)
            {
                foreach ($users as $key => $user) {
                    $output.='<tr>'.
                    '<td>'.$user->id.'</td>'.
                    // '<td>'.$blog->title.'</td>'.
                    // '<td>'.'<a'.' '.'href="'.url('showBlog/'.$user->id).'"target="_bank">'.$user->title. '</a>'.'</td>'.
                    '<td>'.'<a'.' '.'href="#" target="_bank">'.$user->fname.' '. $user->lname. '</a>'.'</td>'.
                    '<td>'.$user->email.'</td>'.
                    '<td>'.$user->tel.'</td>'.
                    '<td>'.$user->role.'</td>'.
                    '<td>'. \Carbon\Carbon::parse($user->created_at)->format('d/m/Y').'</td>'.
                    '<td>'.
                        // '<a'.' '.'href="'.url('blog/laravel/edit/'.$user->id).'"title="Edit">'.
                        '<a'.' '.'href="#" title="Edit">'.
                        '<i class="ti-pencil-alt pr-3 text-warning"></i>'.
                        '</a>'.

                        '<a'.' '.'href="#" data-id="'.$user->id.'" id="deleteBtn" title="Delete">'.
                        '<i class="ti-trash text-danger"></i>'.
                        '</a>'.
                        
                    '</td>'.
                    // '<td>'.$product->description.'</td>'.
                    '</tr>';
                }
                return $output;
                // Response($output);
            }
        }
        
    }






}
