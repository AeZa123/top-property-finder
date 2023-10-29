<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;




class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {

        $users = DB::table('users')
            ->join('roles', 'users.role', '=', 'roles.id', 'left')
            ->select('users.*', 'roles.role_name')->paginate(10);

        return view('backend.views.users.list', compact('users'));
    }




    public function create()
    {
        $genders = DB::table('genders')->select('*')->where('status', 'open')->get();
        $roles = DB::table('roles')->select('*')->where('status', 'open')->get();
        return view('backend.views.users.create', compact('genders', 'roles'));
    }

    public function edit($id)
    {

        $data = User::find($id);
        $genders = DB::table('genders')->select('*')->where('status', 'open')->get();
        $roles = DB::table('roles')->select('*')->where('status', 'open')->get();

        $genders_count = count($genders);
        $roles_count = count($roles);


        $data_html_gender = '';
        for ($i = 0; $i < $genders_count; $i++) {
            $data_html_gender .= '<option value="' . $genders[$i]->id . '"';
            $data_html_gender .= ($data->gender == $genders[$i]->id) ? 'selected' : '';
            $data_html_gender .= '>' . $genders[$i]->gender_name . '</option>';
        }

        $data_html_role = '';
        for ($i = 0; $i < $roles_count; $i++) {
            $data_html_role .= '<option value="' . $roles[$i]->id . '"';
            $data_html_role .= ($data->role == $roles[$i]->id) ? 'selected' : '';
            $data_html_role .= '>' . $roles[$i]->role_name . '</option>';
        }

        // $data_html_role = str_replace('"', '', $data_html_role);
        // $data_html_role = trim($data_html_role, '"');

        // ทำการแสดงผล
        // echo $data_html_role;

        // dd($data_html_role);

        return view('backend.views.users.edit', compact('data', 'data_html_gender', 'data_html_role'));
    }


    public function storage(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string',
                'tel' => 'required|string|min:10|max:10',
                'avatar' => 'image|max:5120|mimes:jpeg,png,jpg',
            ],
            [
                'fname.required' => 'กรุณาระบุชื่อ',
                'lname.required' => 'กรุณาระบุนามสกุล',
                'email.required' => 'กรุณาระบุอีเมล',
                'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
                'email.email' => 'กรุณาใส่อีเมลให้ถูกต้อง',
                'password.required' => 'กรุณาระบุรหัสผ่าน',
                'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
                'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
                'role.required' => 'กรุณาระบุประเภทผู้ใช้งาน',
                'tel.required' => 'กรุณาระบุเบอร์โทรศัพท์',
                'tel.min' => 'เบอร์โทรศัพท์ต้องมี 10 หลัก',
                'tel.max' => 'เบอร์โทรศัพท์ต้องมี 10 หลัก',
                'avatar.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
                'avatar.max' => 'รูปภาพต้องมีขนาดไม่เกิน 5MB',
                'avatar.mimes' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ jpg, jpeg, png',
            ]
        );

        //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
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


        $file = $request->file('avatar');
        if (!empty($file)) {
            $name_image = $this->uploadImage($request->data_base64);
            $data['avatar'] = $name_image;
            $request->avatar->move('storage/images/users/original', $name_image); // img = 'img' ตัวนี้
        }

        User::create($data);
        return response()->json(['code' => 1, 'msg' => 'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);
    }


    //
    public function uploadImage($data_base64)
    {
        $folderPath = public_path('storage/images/users/');
        $image_parts = explode(";base64,", $data_base64);
        // $image_parts = explode(";base64,", $request->image);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath . $imageName;
        file_put_contents($imageFullPath, $image_base64);

        return $imageName;
    }



    public function update(Request $request, $id)
    {


        $validator = \Validator::make(
            $request->all(),
            [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'email' => [
                    'required',
                    'string',
                    'email',
                    Rule::unique('users')->ignore($id),
                ],
                'role' => 'required|string',
                'tel' => 'required|string|min:10|max:10',
                'avatar' => 'image|max:5120|mimes:jpeg,png,jpg',
            ],
            [
                'fname.required' => 'กรุณาระบุชื่อ',
                'lname.required' => 'กรุณาระบุนามสกุล',
                'email.required' => 'กรุณาระบุอีเมล',
                'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
                'email.email' => 'กรุณาใส่อีเมลให้ถูกต้อง',
                'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
                'role.required' => 'กรุณาระบุประเภทผู้ใช้งาน',
                'tel.required' => 'กรุณาระบุเบอร์โทรศัพท์',
                'tel.min' => 'เบอร์โทรศัพท์ต้องมี 10 หลัก',
                'tel.max' => 'เบอร์โทรศัพท์ต้องมี 10 หลัก',
                'avatar.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
                'avatar.max' => 'รูปภาพต้องมีขนาดไม่เกิน 5MB',
                'avatar.mimes' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ jpg, jpeg, png',
            ]
        );

        //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $data = array(
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'role' => $request->role,
            'tel' => $request->tel,
            'gender' => isset($request->gender) ? $request->gender : null,
        );
        // เช็คว่ามีการเปลี่ยนไฟล์หรือไม่
        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            if (!empty($file)) {

                $image_old = User::where('id', $id)->first();
                // ลบไฟล์รูปเก่า
                $name_image_old = $image_old->avatar;
                $oldImagePath = 'storage/images/users/' . $name_image_old;
                $oldOriginalImagePath = 'storage/images/users/original/' . $name_image_old;

                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
                if (file_exists($oldOriginalImagePath)) {
                    @unlink($oldOriginalImagePath);
                }

                $name_image = $this->uploadImage($request->data_base64);
                // กำหนดชื่อเอาไว้บันทึกใน db
                $data['avatar'] = $name_image;
                // เก็บไฟล์ใหม่
                $request->avatar->move('storage/images/users/original', $name_image); // img = 'img' ตัวนี้
            }
        }

        $updated = User::where('id', $id)->update($data);

        return response()->json(['code' => 1, 'msg' => 'ได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว']);
    }




    public function destroy(Request $request)
    {

        $data = User::where('id', $request->id)->first();

        $name_image_old = $data->avatar;
        $oldImagePath = 'storage/images/users/' . $name_image_old;
        $oldOriginalImagePath = 'storage/images/users/original/' . $name_image_old;

        if (file_exists($oldImagePath)) {
            @unlink($oldImagePath);
        }
        if (file_exists($oldOriginalImagePath)) {
            @unlink($oldOriginalImagePath);
        }

        $data = User::where('id', $request->id)->delete();

        if ($data) {
            return response()->json(['code' => 1, 'msg' => 'ได้ทำการลบข้อมูลเรียบร้อยแล้ว']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'ลบข้อมูลไม่สำเร็จ']);
        }
    }


    public function search(Request $request)
    {
        $folderPath = url('storage/images/users/');

        $output = "";
        $users = DB::table('users')
            ->join('roles', 'users.role', '=', 'roles.id', 'left')
            ->where('fname', 'LIKE', '%' . $request->search . "%")
            ->orWhere('lname', 'LIKE', '%' . $request->search . "%")
            ->orWhere('email', 'LIKE', '%' . $request->search . "%")
            ->orWhere('tel', 'LIKE', '%' . $request->search . "%")
            ->orWhere('role_name', 'LIKE', '%' . $request->search . "%")
            ->select('users.*', 'roles.role_name')
            ->paginate(15);

        if ($users) {
            foreach ($users as $key => $user) {
                $avatarUrl = $user->avatar ? $folderPath . '/' . $user->avatar : $folderPath . '/653d4e8e1a4e0.png';
                $imgTag = '<div>' .
                    '<img src="' . $avatarUrl . '" class="img-circle " alt="User Image">' .
                    '</div>';

                $codeColorText = '';
                $codeColorBg = '';
                if ($user->role == 1) {
                    $codeColorText = '#e11d48';
                    $codeColorBg = '#ffe4e6';
                } elseif ($user->role == 2) {
                    $codeColorText = '#ea580c';
                    $codeColorBg = '#ffedd5';
                } elseif ($user->role == 3) {
                    $codeColorText = '#0891b2';
                    $codeColorBg = '#cffafe';
                }

                $output .= '<tr>' .
                    '<td>' . $user->id . '</td>' .
                    '<td>' .
                    '<a href="#" target="_bank">' .
                    '<div class="user-panel d-flex align-items-center justify-content-center text-center">' .
                    $imgTag .
                    '<div class="ml-2">' .
                    $user->fname . ' ' . $user->lname .
                    '</div>' .
                    '</div>' .
                    '</a>' .
                    '</td>' .
                    '<td>' . $user->email . '</td>' .
                    '<td>' . $user->tel . '</td>' .
                    '<td>' .
                    '<div class="row justify-content-center">' .
                    '<div class="col-md-8 text-center" style="border-radius: 12px; background-color: ' . $codeColorBg . '; color: ' . $codeColorText . ';">' .
                    '<b> ' . $user->role_name . '</b>' .
                    '</div>' .
                    '</div>' .
                    '</td>' .

                    '<td>' . \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') . '</td>' .

                    '<td>' .
                    '<a class="mr-1" href="' . url('user/edit/' . $user->id) . '" title="Edit">' .
                    '<i class="fas fa-edit btn btn-warning"></i>' .
                    '</a>' .

                    '<a href="#" data-id="' . $user->id . '" id="deleteBtn" title="Delete">' .
                    '<i class="fas fa-trash-alt btn btn-danger text-white"></i>' .
                    '</a>' .
                    '</td>' .
                    '</tr>';
            }
            return $output;
        }
    }
}
