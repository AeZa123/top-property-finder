<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
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
}
