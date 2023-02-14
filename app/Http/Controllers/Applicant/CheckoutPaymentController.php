<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class CheckoutPaymentController extends Controller
{
    public function CheckoutVNPAY(Request $request)
    {
        $redirect = $request->redirect;

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('applicant.processing_checkout_vnpay');
        $vnp_TmnCode = "U5NIEC96";//Mã website tại VNPAY
        $vnp_HashSecret = "BJNTNULQOXXJDDBGGZCXLRXIHHFPCCDB"; //Chuỗi bí mật

        $vnp_TxnRef = $request->code_bill; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh Toan Ve Nha " . config('app.name');
        $vnp_OrderType = 240000;
        $vnp_Amount = $request->total_price * 100; // tien
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

//        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
//            $inputData['vnp_BankCode'] = $vnp_BankCode;
//        }
//        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
//            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
//        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
                            , 'message' => 'success'
                            , 'data' => $vnp_Url);
        if (isset($redirect)) {
            header('Location: ' . $vnp_Url);
            die();
        }
        else {
            echo json_encode($returnData);
        }
    }

    public function ProcessingVNPAY(Request $request){
        /* Payment Notify
         * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
         * Các bước thực hiện:
         * Kiểm tra checksum
         * Tìm giao dịch trong database
         * Kiểm tra số tiền giữa hai hệ thống
         * Kiểm tra tình trạng của giao dịch trước khi cập nhật
         * Cập nhật kết quả vào Database
         * Trả kết quả ghi nhận lại cho VNPAY
         */


        $vnp_TmnCode = "U5NIEC96";//Mã website tại VNPAY
        $vnp_HashSecret = "BJNTNULQOXXJDDBGGZCXLRXIHHFPCCDB"; //Chuỗi bí mật

//        require_once("./config.php");
        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                $order = Bill::query()
                    ->select('bills.*')
                    ->where('bills.code','=',$orderId)
                    ->first();
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);
                if ($order != NULL) {
                    if($order["price"] == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
//                        dd($order["status"]);
                        if ($order["status"] !== NULL && $order["status"] === 0) {


                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
//                                dd(1);
                                $status = 1; // Trạng thái thanh toán thành công
                                $arr['payment_method'] = 0;
                                $arr['status'] = 1;

                                $object = $order;
                                $object -> fill($arr);
                                $object->save();

                                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                                //
                                //
                                //
                                //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                                $returnData['RspCode'] = '00';
                                $returnData['Message'] = 'Thanh Toán Thành Công';
                            } else {
                                $returnData['RspCode'] = '99';
                                $returnData['Message'] = 'Thanh toán bị lỗi vui lòng thử lại sau';
                            }
                        } else {
//                            dd(2);
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Đơn Hàng Đã Được Thanh Toán';
                        }
                    }
                    else {

//                        dd(3);
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'Bạn Thanh Toán Không Khớp Rồi';
                    }
                } else {
//                    dd(4);
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Đơn Hàng Không Được Tìm Thấy';
                }
            } else {
//                dd(5);
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Đơn Hàng Không Khớp Vui Lòng Thử Lại';
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Thanh Toán Bị Lỗi Vui Lòng Thử Lại Sau';
        }
        //Trả lại VNPAY theo định dạng JSON
//        dd(6);
        echo json_encode($returnData);
        if($returnData['RspCode'] === '00'){
            return redirect()->route('index')->with('success',$returnData['Message']);
        }
        return redirect()->route('index')->with('error',$returnData['Message']);
    }
}
