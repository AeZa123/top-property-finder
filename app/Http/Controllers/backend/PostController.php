<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    

    
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        
        $datas = DB::table('posts')->select('*')->paginate(10);
        return view('backend.views.posts.list', compact('datas'));

    }


    public function create(){

        $property_type = DB::table('property_type')->select('*')->get();
        $sales_type = DB::table('sales_type')->select('*')->get();

        return view('backend.views.posts.create',compact('property_type','sales_type'));

    }


    public function storage(Request $request){

        $validator = \Validator::make($request->all(),[
            'title' => 'required|string',
            'body' => 'required|string',
            'price' => 'required|string|numeric',
            'amount' => 'required|string|numeric',
            'property_name' => 'required|string',
            'sale_type_id' => 'required|string',
            'property_type_id' => 'required|string',
        ],
        [
            'title.required'=>'กรุณาระบุหัวข้อ',
            'body.required'=>'กรุณาระบุเนื้อหา',
            'price.required'=>'กรุณาระบุราคา',
            'price.numeric'=>'กรุณาระบุราคาเป็นตัวเลข',
            'amount.required'=>'กรุณาระบุจํานวน',
            'amount.numeric'=>'กรุณาระบุจํานวนเป็นตัวเลข',
            'sale_type_id.required'=>'กรุณาระบุประเภทการขาย',
            'property_type_id.required'=>'กรุณาระบุประเภทอสังหา',
            'property_name.required'=>'กรุณาระบุชื่ออสังหา',
        ]);

        //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }


        // dd($request->sale_type_id);

        $data = array(
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'amount' => $request->amount,
            'sale_type_id' => $request->sale_type_id,
            'property_type_id' => $request->property_type_id,
            'property_name' => $request->property_name,
            'user_id' => Auth::user()->id,
        );


        // $file = $request->file('avatar');

        // if(!empty($file)){


        //     $photo = $request->file('avatar'); // img = ชื่อ name ใน input
        //     $photoname = time() . '.' . $photo->getClientOriginalExtension();
        //     $request->avatar->move('storage/images/users', $photoname); // img = 'img' ตัวนี้

        //     // resize_image

        //     // $this->resize_image($photo, 200, 200);

        //     // $img->move('storage/images/users', $photoname); // img = 'img' ตัวนี้
        //     $data['avatar'] = $photoname;
        // }

        // dd($file_name);

        // if($upload){
        //     Product::insert([
        //         'product_name'=>$request->product_name,
        //         'product_image'=>$file_name,
        //     ]);
        //     return response()->json(['code'=>1,'msg'=>'New product has been saved successfully']);
        // }


        // DB::table('blogs')->insert($data);
        Post::create($data);
        // return redirect('table/laravel');
        return response()->json(['code'=>1,'msg'=>'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);

    }



}
