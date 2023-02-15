<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class CheckoutPaymentController extends Controller
{
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function checkoutMOMO(Request $request){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->total_price;
        $orderId = $request->code_bill;
        $redirectUrl = route('applicant.processing_checkout_momo');
        $ipnUrl = route('applicant.processing_checkout_momo');
        $extraData = "";

            $requestId = time() . "";
            $requestType = "captureWallet";
//            $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                          'partnerName' => "Nha " . config('app.name'),
                          "storeId" => "Thanh Toan Ve Xe",
                          'requestId' => $requestId,
                          'amount' => $amount,
                          'orderId' => $orderId,
                          'orderInfo' => $orderInfo,
                          'redirectUrl' => $redirectUrl,
                          'ipnUrl' => $ipnUrl,
                          'lang' => 'vi',
                          'extraData' => $extraData,
                          'requestType' => $requestType,
                          'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
//        dd($jsonResult);
            if($jsonResult['resultCode'] == '0'){
                return redirect()->to($jsonResult['payUrl']);
            }

            return redirect()->route('index')->with('error',$jsonResult['message']);

            //Just a example, please check more in there
    }

    public function processingMOMO(Request $request){
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $response = array();
            try {
                $partnerCode = $_GET["partnerCode"];
                $orderId = $_GET["orderId"];
                $requestId = $_GET["requestId"];
                $amount = $_GET["amount"];
                $orderInfo = $_GET["orderInfo"];
                $orderType = $_GET["orderType"];
                $transId = $_GET["transId"];
                $resultCode = $_GET["resultCode"];
                $message = $_GET["message"];
                $payType = $_GET["payType"];
                $responseTime = $_GET["responseTime"];
                $extraData = $_GET["extraData"];
                $m2signature = $_GET["signature"]; //MoMo signature

                //Checksum
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                    "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime .
                    "&resultCode=" . $resultCode . "&transId=" . $transId;

                $partnerSignature = hash_hmac("sha256", $rawHash, 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa');

                if ($m2signature == $partnerSignature) {
                    if ($resultCode == '0') {
                        $order = Bill::query()
                            ->select('bills.*')
                            ->where('bills.code','=',$orderId)
                            ->first();
                        if ($order != NULL) {
                            if($order["price"] == $amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                            {
                                if ($order["status"] !== NULL && $order["status"] === 0) {
                                        $arr['payment_method'] = 2;
                                        $arr['status'] = 1;

                                        $object = $order;
                                        $object -> fill($arr);
                                        $object->save();
                                    $notify = 'Thanh toán thành công';
                                } else {
                                    $notify = 'Đơn Hàng Đã Được Thanh Toán';
                                }
                            }
                            else {
                                $notify = 'Bạn Thanh Toán Không Khớp Số Tiền';
                            }
                        }else{
                            $notify = 'Không tìm thấy đơn';
                        }
                    } else {
                        $notify =$message;
                    }
                } else {
                    $notify = 'This transaction could be hacked, please check your signature and returned signature';
                }

            } catch (\Exception $e) {

                $notify = $e;
                echo $response['message'] = $e;
            }

            $debugger = array();
            $debugger['rawData'] = $rawHash;
            $debugger['momoSignature'] = $m2signature;
            $debugger['partnerSignature'] = $partnerSignature;

            if ($m2signature == $partnerSignature) {
                $notify = "Nhận kết quả thanh toán thành công";
                $response['message'] = "Received payment result success";
            } else {
                $notify = "LỖI! tổng kiểm tra thất bại";
                $response['message'] = "ERROR! Fail checksum";
            }
            $response['debugger'] = $debugger;
            echo json_encode($response);

            if($resultCode === '0'){
                return redirect()->route('index')->with('success',$notify);
            }
            return redirect()->route('index')->with('error',$notify);
    }

    public function checkoutVNPAY(Request $request)
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

    public function processingVNPAY(Request $request){
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
