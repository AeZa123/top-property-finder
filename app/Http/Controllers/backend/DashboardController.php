<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function dashboard(){



        // dd('test');
        $count_user = DB::table('users')->count();
        $count_post = DB::table('posts')->where('delete_post', '=', null)->orWhere('delete_post', '=', '')->count();

        $response = array();
        $response['count_user'] = $count_user;
        $response['count_post'] = $count_post;


        return view('backend.views.dashboard.dashboard', compact('response'));
    }






}
