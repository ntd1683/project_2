<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {

    }

    public function test()
    {
        return redirect()->route('test1')->with('error123','1234');
    }
    public function test1()
    {
        dd(session()->get('error123'));
    }

    public function get_test(Request $request){
    }
}
