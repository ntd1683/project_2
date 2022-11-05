<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Buses;
use App\Models\Location;
use App\Models\Seat;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {

    }

    public function test()
    {
        $arr = [];
        for ($i = 1; $i <= 5; $i++) {
            if($i == 3){
                $i = 1;
                $arr[]=[
                    $i,$i,$i
                ];
                $i = 3;
            }else{
                $arr[]=[
                    $i,$i,$i
                ];
            }
        }
        return array_unique($arr);
    }
    public function test1(request $request)
    {
        function getCaptcha($SecretKey){
            $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret="."&response={$SecretKey}");
            $Return = json_decode($Response);
            return $Return;
        }
        $Return = getCaptcha($_GET['g-recaptcha-reponse']);
        if($Return->success == true && $Return->score > 0.5){
            return redirect()->route('test2',$request)->with('success','Thành công');
        }
        return redirect()->route('test')->with('error','Mày Là Robot');
    }

    public function test2(Request $request){
        dd($request);
    }
}
