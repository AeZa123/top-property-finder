<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;


class IndexController extends Controller
{



    public function index(Request $request)
    {

        $property_types = DB::table('property_type')->select('*')->get();
        $thai_provinces = DB::table('thai_provinces')->select('name_th', 'id')->get();
        $count_property_type = count($property_types);
        $count_thai_provinces = count($thai_provinces);

        $data_html_proper_type = '';
        for ($i = 0; $i < $count_property_type; $i++) {
            $data_html_proper_type .= '<option value="' . $property_types[$i]->id . '"';
            $data_html_proper_type .= '>' . $property_types[$i]->name_property_type . '</option>';
        }

        $data_html_thai_provinces = '';
        for ($i = 0; $i < $count_thai_provinces; $i++) {
            $data_html_thai_provinces .= '<option value="' . $thai_provinces[$i]->id . '"';
            $data_html_thai_provinces .= '>' . $thai_provinces[$i]->name_th . '</option>';
        }



        $datas = DB::table('posts')
            // ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('property_type', 'posts.property_type_id', '=', 'property_type.id')
            ->join('sales_type', 'posts.sale_type_id', '=', 'sales_type.id')
            ->orderBy('posts.id', 'desc')
            ->select('posts.*', DB::raw('FORMAT(price, 0) as price_format'), 'users.fname', 'users.lname', 'sales_type.name_sale_type', 'property_type.name_property_type')
            ->where('posts.delete_post', '=',  null)
            ->orWhere('posts.delete_post', '=',  '')
            ->paginate(3);


        // โหลดข้อมูลมาใส่ในไฟล์ data.blade.php เก็บในตัวแปร $view จะได้เป็น html ออกมา
        if ($request->ajax()) {
            $view = view('frontend.views.load-data', compact('datas'))->render();

            // dd($view);


            return response()->json(['html' => $view]);
        }




        return view('frontend.views.index', compact('datas', 'data_html_proper_type', 'data_html_thai_provinces', 'property_types'));
    }

    public function about()
    {

        return view('frontend.views.about');
    }

    public function contact()
    {

        return view('frontend.views.contact');
    }


    public function getListPropertyInType($id)
    {

        $datas = DB::table('posts')
            ->join('sales_type', 'posts.sale_type_id', '=', 'sales_type.id')
            ->join('property_type', 'posts.property_type_id', '=', 'property_type.id')
            ->where('property_type_id', '=', $id)
            ->where('posts.delete_post', '=',  null)
            ->select('posts.*', DB::raw('FORMAT(price, 0) as price_format'), 'sales_type.name_sale_type', 'property_type.name_property_type')
            ->paginate(20);

        $name_property_type = DB::table('property_type')->select('name_property_type')->where('id', '=', $id)->first();


        return view('frontend.views.type_property', compact('datas', 'name_property_type'));
    }


    public function detail_property($id)
    {


        $images = DB::table('image_posts')->where('post_id', '=', $id)
            ->join('images', 'image_posts.image_id', '=', 'images.id')
            ->select('images.*')
            ->get();

        // dd($images);

        $data = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.fname', 'users.lname', 'users.email', 'users.tel', 'users.avatar')
            ->where('posts.id', '=', $id)
            ->first();

        // dd($data);

        return view('frontend.views.detail_property', compact('images', 'data'));
    }




    public function search_property(Request $request)
    {


        // dd($request->all());
        $property_types = DB::table('property_type')->select('*')->get();
        $thai_provinces = DB::table('thai_provinces')->select('name_th', 'id')->get();
        $count_property_type = count($property_types);
        $count_thai_provinces = count($thai_provinces);


        $data_html_proper_type = '';
        for ($i = 0; $i < $count_property_type; $i++) {
            $data_html_proper_type .= '<option value="' . $property_types[$i]->id . '"';
            $data_html_proper_type .= '>' . $property_types[$i]->name_property_type . '</option>';
        }

        $data_html_thai_provinces = '';
        for ($i = 0; $i < $count_thai_provinces; $i++) {
            $data_html_thai_provinces .= '<option value="' . $thai_provinces[$i]->id . '"';
            $data_html_thai_provinces .= '>' . $thai_provinces[$i]->name_th . '</option>';
        }


        $datas = DB::table('posts')
            ->join('property_type', 'posts.property_type_id', '=', 'property_type.id')
            ->join('sales_type', 'posts.sale_type_id', '=', 'sales_type.id')
            ->whereNull('posts.delete_post')
            ->where(function ($query) use ($request) {
                $query->where('posts.thai_provinces_id', 'like', '%' . $request->provinces_id . '%')
                    ->Where('posts.property_type_id', 'like', '%' . $request->property_type_id . '%')
                    ->Where('posts.title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('posts.property_name', 'like', '%' . $request->keyword . '%');
            })
            ->select('posts.*', DB::raw('FORMAT(price, 0) as price_format'), 'sales_type.name_sale_type', 'property_type.name_property_type')
            ->orderBy('posts.id', 'desc')
            ->paginate(20);


        // dd($datas, $request->keyword, $request->property_type_id, $request->provinces_id);


        // dd($datas, $request->keyword, $request->property_type_id, $request->provinces_id);

        return view('frontend.views.search_property', compact('datas', 'data_html_proper_type', 'data_html_thai_provinces'));
    }
}
