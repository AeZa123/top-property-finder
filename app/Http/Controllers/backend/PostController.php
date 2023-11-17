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

        // $datas = DB::table('posts')->where('delete_post', '=', null)->paginate(10);
        $datas = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id', 'left')
            ->where('delete_post', '=', null)
            ->orWhere('delete_post', '=', '')
            ->select('posts.*', 'users.fname', 'users.lname')
            ->paginate(10);
        return view('backend.views.posts.list', compact('datas'));
    }


    public function create()
    {

        $property_type = DB::table('property_type')->select('*')->get();
        $sales_type = DB::table('sales_type')->select('*')->get();
        $thai_provinces = DB::table('thai_provinces')->select('*')->get();

        return view('backend.views.posts.create', compact('property_type', 'sales_type', 'thai_provinces'));
    }


    public function storage(Request $request)
    {

        // dd($request->all());
        $validator = \Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'price' => 'required|string|numeric',
                'amount' => 'required|string|numeric',
                'bathroom' => 'required|string|numeric',
                'bedroom' => 'required|string|numeric',
                'area' => 'required|string|numeric',
                'image_cover' => 'required|image|mimes:jpeg,png,jpg|max:5000',
                'property_name' => 'required|string',
                'sale_type_id' => 'required|string',
                'property_type_id' => 'required|string',
                'thai_provinces_id' => 'required|string',
            ],
            [
                'title.required' => 'กรุณาระบุหัวข้อ',
                'body.required' => 'กรุณาระบุเนื้อหา',
                'price.required' => 'กรุณาระบุราคา',
                'price.numeric' => 'กรุณาระบุราคาเป็นตัวเลข',
                'amount.required' => 'กรุณาระบุจํานวน',
                'amount.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'bathroom.required' => 'กรุณาระบุจํานวน',
                'bathroom.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'bedroom.required' => 'กรุณาระบุจํานวน',
                'bedroom.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'area.required' => 'กรุณาระบุจํานวน',
                'thai_provinces_id.required' => 'กรุณาระบุจังหวัด',
                'area.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'sale_type_id.required' => 'กรุณาระบุประเภทการขาย',
                'property_type_id.required' => 'กรุณาระบุประเภทอสังหา',
                'property_name.required' => 'กรุณาระบุชื่ออสังหา',
                'image_cover.required' => 'กรุณาเพิ่มปกประกาศ',
                'image_cover.image' => 'กรุณาเพิ่มปกประกาศเป็นรูปภาพ',
                'image_cover.mimes' => 'รับประเภทไฟล์เป็น jpeg, png, jpg',
                'image_cover.max' => 'รับขนาดไฟล์ไม่เกิน 2MB',
            ]
        );

        //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }


        // dd($request->sale_type_id);

        $data = array(
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'amount' => $request->amount,
            'bathroom' => $request->bathroom,
            'bedroom' => $request->bedroom,
            'area' => $request->area,
            'sale_type_id' => $request->sale_type_id,
            'property_type_id' => $request->property_type_id,
            'property_name' => $request->property_name,
            'date_start_rent' => isset($request->date_start_rent) ? $request->date_start_rent : null,
            'thai_provinces_id' => $request->thai_provinces_id,
            'user_id' => Auth::user()->id,
        );


       
        $file_image_cover = $request->file('image_cover');
        if (!empty($file_image_cover)) {
            $name_image = $this->uploadImage($request->data_base64);
            $data['image_cover'] = $name_image;
           
        }

        // create post
        $createPost = Post::create($data);
        $post_id = $createPost->id;


      
        $file = $request->file('images');

        if (!empty($file)) {

            $uniqueImages = [];
            $originalNames = [];

            foreach ($request->images as $image_1) {
                $originalName = $image_1->getClientOriginalName();
                if (!in_array($originalName, $originalNames)) {
                    $originalNames[] = $originalName;
                    $uniqueImages[] = $image_1;
                }
            }


            // $request->merge(['images' => $uniqueImages]);
            $request->request->set('images_filter', $uniqueImages);
            // dd( $request->images_filter[0]);
            $count = count($request->images_filter);
           
         
            // $count = count($file);
            for ($i = 0; $i < $count; $i++) {
                $photo = $request->file('images')[$i]; // img = ชื่อ name ใน input
                $photoname = uniqid() . '-' . date('Y-m-d') . time() . '.' . $photo->getClientOriginalExtension();
                $request->images[$i]->move('storage/images/property_image', $photoname); // img = 'img' ตัวนี้

                $image['image_name'] = $photoname;
                $createdImage = Image::create($image); // create image
                $imagePost['post_id'] = $post_id;
                $imagePost['image_id'] = $createdImage->id;

                ImagePost::create($imagePost); //create image post

            }

        }


        // return redirect('table/laravel');
        return response()->json(['code' => 1, 'msg' => 'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);
    }


    public function uploadImage($data_base64)
    {
        $folderPath = public_path('storage/images/property_image/image_cover/');
        if (!file_exists($folderPath)) {
            // ถ้าโฟลเดอร์ไม่มีอยู่ ให้สร้างขึ้นมา
            mkdir($folderPath, 0777, true);
        }



        
        // แปลง JSON เป็นโครงสร้างข้อมูล
        $data = json_decode($data_base64, true);

        // dd($data_base64);
        // เข้าถึงค่าของ "image"
        $image_data = $data[0]['image'];

        // ตัดสตริงออกมาโดยใช้ substr
        $start = strpos($image_data, "data:image/png;base64,");
        if ($start !== false) {
            $image_data = substr($image_data, $start);
        }



        $image_parts = explode(";base64,", $image_data);
        // $image_parts = explode(";base64,", $data_base64);
        // $image_parts = explode(";base64,", $request->image);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath . $imageName;
        file_put_contents($imageFullPath, $image_base64);

        return $imageName;
    }




    public function edit($id)
    {



        $data = Post::find($id);
        $imagePosts = ImagePost::where('post_id', $id)
            ->join('images', 'image_posts.image_id', '=', 'images.id')
            ->select('images.id as image_id', 'images.image_name', 'post_id', 'image_posts.id as image_post_id')
            ->get();

        // dd($imagePosts);
        $property_type = DB::table('property_type')->select('*')->get();
        $sales_type = DB::table('sales_type')->select('*')->get();
        $thai_provinces = DB::table('thai_provinces')->select('name_th', 'id')->get();

        $count_property_type = count($property_type);
        $count_sales_type = count($sales_type);
        $count_thai_provinces = count($thai_provinces);

        $data_html_proper_type = '';
        for ($i = 0; $i < $count_property_type; $i++) {
            $data_html_proper_type .= '<option value="' . $property_type[$i]->id . '"';
            $data_html_proper_type .= ($data->property_type_id == $property_type[$i]->id) ? 'selected' : '';
            $data_html_proper_type .= '>' . $property_type[$i]->name_property_type . '</option>';
        }

        $data_html_sales_type = '';
        for ($i = 0; $i < $count_sales_type; $i++) {
            $data_html_sales_type .= '<option value="' . $sales_type[$i]->id . '"';
            $data_html_sales_type .= ($data->sale_type_id == $sales_type[$i]->id) ? 'selected' : '';
            $data_html_sales_type .= '>' . $sales_type[$i]->name_sale_type . '</option>';
        }

        $data_html_thai_provinces = '';
        for ($i = 0; $i < $count_thai_provinces; $i++) {
            $data_html_thai_provinces .= '<option value="' . $thai_provinces[$i]->id . '"';
            $data_html_thai_provinces .= ($data->property_type_id == $thai_provinces[$i]->id) ? 'selected' : '';
            $data_html_thai_provinces .= '>' . $thai_provinces[$i]->name_th . '</option>';
        }


        return view('backend.views.posts.edit', compact('data', 'data_html_sales_type', 'data_html_proper_type', 'imagePosts', 'data_html_thai_provinces'));
    }



    public function delete_image($idPostImage, $imageId, $nameImage)
    {
        if (!empty($idPostImage) and !empty($imageId) and !empty($nameImage)) {
            // ImagePost::
            unlink('storage/images/property_image/' . $nameImage);
            $req1 = ImagePost::where('id', $idPostImage)->delete();
            $req2 = Image::where('id', $imageId)->delete();

            return response()->json(['code' => 1, 'msg' => 'ได้ทำการลบข้อมูลเรียบร้อยแล้ว']);
        } else {

            return response()->json(['code' => 0, 'msg' => 'ไม่สามารถลบข้อมูลได้']);
        }
    }





    public function update(Request $request, $id)
    {


        // dd($request->all());

        
        $validator = \Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'price' => 'required|string|numeric',
                'amount' => 'required|string|numeric',
                'bathroom' => 'required|string|numeric',
                'bedroom' => 'required|string|numeric',
                'area' => 'required|string|numeric',
                'image_cover' => 'image|mimes:jpeg,png,jpg|max:2048',
                'property_name' => 'required|string',
                'thai_provinces_id' => 'required',
                'sale_type_id' => 'required|string',
                'property_type_id' => 'required|string',



            ],
            [
                'title.required' => 'กรุณาระบุหัวข้อ',
                'body.required' => 'กรุณาระบุเนื้อหา',
                'price.required' => 'กรุณาระบุราคา',
                'price.numeric' => 'กรุณาระบุราคาเป็นตัวเลข',
                'amount.required' => 'กรุณาระบุจํานวน',
                'amount.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'bathroom.required' => 'กรุณาระบุจํานวน',
                'bathroom.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'bedroom.required' => 'กรุณาระบุจํานวน',
                'bedroom.numeric' => 'กรุณาระบุจํานวนเป็นตัวเลข',
                'area.required' => 'กรุณาระบุพื้นที่',
                'area.numeric' => 'กรุณาระบุพื้นที่เป็นตัวเลข',
                'thai_provinces_id.required' => 'กรุณาระบุจังหวัด',
                'sale_type_id.required' => 'กรุณาระบุประเภทการขาย',
                'property_type_id.required' => 'กรุณาระบุประเภทอสังหา',
                'property_name.required' => 'กรุณาระบุชื่ออสังหา',
                'image_cover.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
                'image_cover.mimes' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ jpg, jpeg, png',
                'image_cover.max' => 'รูปภาพต้องมีขนาดไม่เกิน 2MB',

            ]
        );

        //ถ้า validate ไม่ผ่านให้ส่ง error ไป  แต่ถ้าผ่านให้ทำการบันทึกข้อมูลลง database
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }


        // dd($request->sale_type_id);

        $data = array(
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'amount' => $request->amount,
            'bathroom' => $request->bathroom,
            'bedroom' => $request->bedroom,
            'area' => $request->area,
            'thai_provinces_id' => $request->thai_provinces_id,
            'date_start_rent' => $request->date_start_rent,
            'sale_type_id' => $request->sale_type_id,
            'property_type_id' => $request->property_type_id,
            'property_name' => $request->property_name,
            'user_id' => Auth::user()->id,
        );





          // เช็คว่ามีการเปลี่ยนไฟล์หรือไม่
          if ($request->hasFile('image_cover')) {

            $file = $request->file('image_cover');
            if (!empty($file)) {

                $image_old = Post::where('id', $id)->first();
                // ลบไฟล์รูปเก่า
                $name_image_old = $image_old->image_cover;
                $oldImagePath = 'storage/images/property_image/image_cover/' . $name_image_old;
                // $oldOriginalImagePath = 'storage/images/users/original/' . $name_image_old;

                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
                // if (file_exists($oldOriginalImagePath)) {
                //     @unlink($oldOriginalImagePath);
                // }

                $name_image = $this->uploadImage($request->data_base64);
                // กำหนดชื่อเอาไว้บันทึกใน db
                $data['image_cover'] = $name_image;
                // เก็บไฟล์ใหม่
                // $request->avatar->move('storage/images/property_image/image_cover', $name_image); // img = 'img' ตัวนี้
            }
        }



        if ($request->hasFile('images')) {

            $file = $request->file('images');
            if (!empty($file)) {

                // dd($request->all());

                $count = count($file);
                for ($i = 0; $i < $count; $i++) {
                    $photo = $request->file('images')[$i]; // img = ชื่อ name ใน input
                    $photoname = uniqid() . '-' . date('Y-m-d') . time() . '.' . $photo->getClientOriginalExtension();
                    $request->images[$i]->move('storage/images/property_image', $photoname); // img = 'img' ตัวนี้

                    $image['image_name'] = $photoname;
                    $createdImage = Image::create($image); // create image
                    $imagePost['post_id'] = $id;
                    $imagePost['image_id'] = $createdImage->id;

                    ImagePost::create($imagePost); //create image post

                }
            }
        }

        Post::where('id', $id)->update($data);

        // return redirect('table/laravel');
        return response()->json(['code' => 1, 'msg' => 'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);
    }



    public function destroy(Request $request)
    {

        // dd($request->id);
        $id = $request->id;
        $data = array(
            'delete_post' => 'del',
        );
        Post::where('id', $id)->update($data);

        return response()->json(['code' => 1, 'msg' => 'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว']);

        // unlink('storage/images/property_image/' . $nameImage);
        // $req1 = ImagePost::where('id', $idPostImage)->delete();
        // $req2 = Image::where('id', $imageId)->delete();


    }






    public function search(Request $request)
    {


        // dd($request->all());

        $datas = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id', 'left')
            ->where('title', 'LIKE', '%' . $request->search . "%")
            ->orWhere('price', 'LIKE', '%' . $request->search . "%")
            ->orWhere('property_name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('fname', 'LIKE', '%' . $request->search . "%")
            ->orWhere('lname', 'LIKE', '%' . $request->search . "%")
            // ->orWhere('sale_type_id', 'LIKE', '%' . $request->search . "%")
            // ->orWhere('property_type_id', 'LIKE', '%' . $request->search . "%")

            ->where('delete_post', '=', null)
            ->orWhere('delete_post', '=', '')
            ->select('posts.*', 'users.fname', 'users.lname')
            ->paginate(15);
     

        $output = "";
   

        if ($datas) {
            foreach ($datas as $key => $data) {


                if($data->delete_post != 'del'){
                    $output .= '<tr>' .
                        '<td>' . $data->id . '</td>' .
                       
                        '<td>' . $data->property_name . '</td>' .
                        '<td>' . $data->title . '</td>' .
                        '<td>' . $data->price . '</td>' .
                        '<td>' . $data->amount . '</td>' .
                        '<td>' . $data->fname .' '. $data->lname. '</td>' .
                       
    
                        '<td>' . \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') . '</td>' .
                        '<td>' . \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y') . '</td>' .
    
                        '<td>' .
                        '<a class="mr-1" href="' . url('post/edit/' . $data->id) . '" title="Edit">' .
                        '<i class="fas fa-edit btn btn-warning"></i>' .
                        '</a>' .
    
                        '<a href="#" data-id="' . $data->id . '" id="deleteBtn" title="Delete">' .
                        '<i class="fas fa-trash-alt btn btn-danger text-white"></i>' .
                        '</a>' .
                        '</td>' .
                        '</tr>';

                }
             

            }
            return $output;
        }
    }















}
