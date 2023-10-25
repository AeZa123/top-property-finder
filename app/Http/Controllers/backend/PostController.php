<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Image;
use App\Models\ImagePost;

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

      
        // dd($request->all());
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

        // create post
       $createPost = Post::create($data);
       $post_id = $createPost->id;


        $file = $request->file('images');

        if(!empty($file)){

            $count = count($file);

            for($i=0; $i<$count; $i++){

                $photo = $request->file('images')[$i]; // img = ชื่อ name ใน input
                $photoname = $post_id.$i.date('Y-m-d').time() . '.' . $photo->getClientOriginalExtension();
                $request->images[$i]->move('storage/images/property_image', $photoname); // img = 'img' ตัวนี้

                $image['image_name'] = $photoname;

                $createdImage = Image::create($image); // create image
               
                $imagePost['post_id'] = $post_id;
                $imagePost['image_id'] = $createdImage->id;

                ImagePost::create($imagePost); //create image post

            }

        }

    
        // return redirect('table/laravel');
        return response()->json(['code'=>1,'msg'=>'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);

    }




    public function edit($id){



        $data = Post::find($id);
        $imagePosts = ImagePost::where('post_id', $id)
                      ->join('images', 'image_posts.image_id', '=', 'images.id')
                      ->select('images.id as image_id', 'images.image_name', 'post_id', 'image_posts.id as image_post_id')
                      ->get();

        // dd($imagePosts);
        $property_type = DB::table('property_type')->select('*')->get();
        $sales_type = DB::table('sales_type')->select('*')->get();

        $count_property_type = count($property_type);
        $count_sales_type = count($sales_type);

        $data_html_proper_type = '';
        for($i=0; $i<$count_property_type; $i++){
           $data_html_proper_type .= '<option value="'.$property_type[$i]->id.'"';
           $data_html_proper_type .= ($data->property_type_id == $property_type[$i]->id) ? 'selected' : '';
           $data_html_proper_type .= '>'.$property_type[$i]->name_property_type.'</option>';
        }

        $data_html_sales_type = '';
        for($i=0; $i<$count_sales_type; $i++){
           $data_html_sales_type .= '<option value="'.$sales_type[$i]->id.'"';
           $data_html_sales_type .= ($data->sale_type_id == $sales_type[$i]->id) ? 'selected' : '';
           $data_html_sales_type .= '>'.$sales_type[$i]->name_sale_type.'</option>';
        }


        return view('backend.views.posts.edit',compact('data','data_html_sales_type','data_html_proper_type','imagePosts'));

    }

    public function delete_image($idPostImage, $imageId, $nameImage){


        // $idImagePost = $request->input('idImagePost');
        // $imageName = $request->input('imageName');

        // dd($idPostImage, $nameImage,$imageId);


        // ImagePost::
        unlink('storage/images/property_image/'.$nameImage);
        ImagePost::where('id',$idPostImage)->delete();
        Image::where('id',$imageId)->delete();






        // $data = Image::where('id',$imageId)->delete();




    }



}
