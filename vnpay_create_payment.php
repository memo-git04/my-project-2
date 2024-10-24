<?php

//mục đích trang này là chuyển hướng đến trang thanh toán của vn pay
// input chỉ có số tiền thanh toán và có thể là ngân hành
//khi thanh toán xong sẽ chuyển hướng đến trang $vnp_Url
//khi ng dùng chọn hình thức thanh toán mobile banking thì mới require file này


// Ngân hàng	NCB
// Số thẻ	9704198526191432198
// Tên chủ thẻ	NGUYEN VAN A
// Ngày phát hành	07/15
// Mật khẩu OTP	123456


//exmp variable
//vnp_Amount=6310000
// &vnp_BankCode=NCB
// &vnp_BankTranNo=VNP14480922
// &vnp_CardType=ATM
// &vnp_OrderInfo=Thanh+toan+GD%3A2056
// &vnp_PayDate=20240627092538
// &vnp_ResponseCode=00
// &vnp_TmnCode=D88JTTUK
// &vnp_TransactionNo=14480922
// &vnp_TransactionStatus=00
// &vnp_TxnRef=2056
// &vnp_SecureHash=27495cb545c8232e8c588dd04410203ef784fd67d16701f81c631cda360fca6969cdef225c9e8838539453daf1dea814598369e941162c85c2f09d407566cd17



error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * 
 *
 * @author CTT VNPAY
 */
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "D88JTTUK"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "NOD6N45UJDNDASEU6J4WMYNDBWVHWB12"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

// khi thanh toan xong thi chuyen ket qua den trang ben duoi
$vnp_Returnurl = 'http://localhost/web/confirm_mobilebanking.php';


$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

$vnp_TxnRef = rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant

//số tiền thanh toán
$vnp_Amount = $_SESSION['totalAll']; // Số tiền thanh toán


$vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán

//ngân hàng
//có nhiều ngân hàng nh môi trường test chỉ hỗ trọ ngân hàng NCB
$vnp_BankCode = 'NCB'; //Mã phương thức thanh toán

$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

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
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
header('Location: ' . $vnp_Url);
die();
