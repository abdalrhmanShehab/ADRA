<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class frontController extends Controller
{
    public function index(){
        return view('front.index');
    }

    public function contactUs(){
        return view('front.contactus');
    }
}
