<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\SeatTypeEnum;
use App\Enums\StatusBillEnum;
use App\Models\Bill;
use App\Models\Buses;
use App\Models\Carriage;
use App\Models\Location;
use App\Models\Seat;
use App\Models\Seat_map;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
    public function test()
    {
        $result = Bill::query()
            ->select('bills.*')
            ->where('bills.code','=','B3QJ2Y0TYB')
            ->first();
        if($result==NULL) {
            return 1;
        }
        return $result;
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
