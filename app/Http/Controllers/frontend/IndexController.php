<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;


class IndexController extends Controller
{
    


    public function index(){
        $datas = DB::table('posts')
                // ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->orderBy('posts.id', 'desc') 
                ->select('posts.*', 'users.fname', 'users.lname')
                ->where('posts.delete_post', '=',  null)
                ->orWhere('posts.delete_post', '=',  '')
                ->limit(9)
                ->get();

        return view('frontend.views.index', compact('datas'));
    }



    public function detail_property($id){


        $images = DB::table('image_posts')->where('post_id', '=', $id)
        ->join('images', 'image_posts.image_id', '=', 'images.id')
        ->select('images.*')
        ->get();

        // dd($images);

        $data = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.fname', 'users.lname')
                ->where('posts.id', '=', $id)
                ->first();

        

        return view('frontend.views.detail_property', compact('images', 'data'));
    }




    public function search_property(Request $request){


        
        










    }



}
