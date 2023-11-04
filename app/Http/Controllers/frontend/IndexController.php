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
                ->get();

        return view('frontend.views.index', compact('datas'));
    }



}
