<?php

ob_start();
session_start();
$title = "Confirm";

if (!isset($_SESSION['cust'])) {
    header('location: http://localhost/web/login.php');
}
$cusid = $_SESSION['cust']['cus_id'];
include_once "default/header.php";

include_once "admin/config/db.php";
$connect = doConnection();

$message = [];
if (isset($_GET['vnp_TransactionStatus']) && $_GET['vnp_TransactionStatus'] == '00') {
    $data = $_SESSION['data'];
    $cus_name = $data['name'];
    $cus_phone = $data['phone'];
    $cus_add = $data['address'];
    $amount = $data['amount'];
    $pay = $data['payment'];
    $cus_id = $_SESSION['cust']['cus_id'];
    $date = date('Y-m-d H:i:s');
    $sqlInsertOrder = "INSERT INTO orders (cus_id, receiver_name, receiver_phone, receiver_address, status_id, order_date, payment_method)
                                VALUES ($cus_id, '$cus_name', '$cus_phone', '$cus_add', 1, '$date',  1)";
    $query = mysqli_query($connect, $sqlInsertOrder);
    // echo $sqlInsertOrder;


    //tao du lieu cho bang ord
    $ord_id = mysqli_insert_id($connect);
    foreach ($_SESSION['cart'][$cus_id] as $pr_id => $quantity) {
        // echo var_dump($quantity);
        $sqlProduct =   "SELECT * FROM product WHERE pr_id = $pr_id";
        $querysqlProduct = mysqli_query($connect, $sqlProduct);
        $product = mysqli_fetch_assoc($querysqlProduct);
        $price = $product['pr_price'];
        $quantity = $quantity['quantity'];
        $total_price = $price *  $quantity;
        $sqlInsertOrdDetail = "INSERT INTO order_detail (order_id,pr_id , price, quantity, total_price) 
                                        VALUES ($ord_id, $pr_id, $price, $quantity, $price)";
        mysqli_query($connect, $sqlInsertOrdDetail);
    }
    unset($_SESSION['cart']);
    $message['success'] = '  <div class="text text-sucess">
                                Order has been paid successfully!
                              </div>
                            </div>';
} else {
    $message['fail'] = 'Order has not been paid or payment has not been successful';
}


// var_dump($message);
?>

<h3>
    <?php foreach ($message as $key => $value) {
        echo $value;
    }
    ?>
</h3>

<?php
include_once "default/footer.php";
?>