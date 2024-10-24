<?php
ob_start();
session_start();
include_once "admin/config/db.php";
$connect = doConnection();

// check dang nhap thi moi  && isset($_SESSION['cus_login']

if (isset($_GET['action']) && isset($_SESSION['cust'])) {
    // echo "<pre>";
    // print_r($_SESSION['id']);
    // add product
    if ($_GET['action'] == 'add') {
        $pr_id = $_GET['id'];
        //lay gio hang cua user
        $cus_id = $_SESSION['cust']['cus_id'];

        if (isset($_SESSION['cart'][$cus_id][$pr_id])) {
            $_SESSION['cart'][$cus_id][$pr_id]['quantity']++;
        } else {
            $_SESSION['cart'][$cus_id][$pr_id]['quantity'] = 1;
        }
        header('Location:cart.php');
        // echo "<pre>";
        // print_r($_SESSION['cart']);
    }


    // update product
    if ($_GET['action'] == 'update') {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_POST['check']);

        //check so luong sp o input
        if (isset($_POST['submit_update'])) {
            $cus_id = $_SESSION['cust']['cus_id'];
            foreach ($_POST['quantity'] as $prdId => $quantity) {
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$cus_id][$prdId]);
                } else {
                    $_SESSION['cart'][$cus_id][$prdId]['quantity'] = $quantity;
                }
            }
            header('Location:cart.php');
        }
    }



    // delete product
    if ($_GET['action'] == 'delete') {
        $pr_id = $_GET['id'];
        $cus_id = $_SESSION['cust']['cus_id'];
        unset($_SESSION['cart'][$cus_id][$pr_id]);
        header('Location:cart.php');
    }
    if (isset($_POST['delete_all'])) {
        unset($_SESSION['cart']);
        echo $_SESSION['cart'];
        header('Location:cart.php');
    }


    // luu vao don hang
    if ($_GET['action'] == 'store') {
        if (isset($_POST['sm_checkout'])) {

            if ($_POST['payment']) {
                //tao csdl cho bang order
                $cus_name = $_POST['name'];
                $cus_phone = $_POST['phone'];
                $cus_add = $_POST['address'];
                $amount = $_POST['amount'];
                $pay = $_POST['payment'];
                $cus_id = $_SESSION['cust']['cus_id'];
                $date = date('Y-m-d H:i:s');
                $sqlInsertOrder = "INSERT INTO orders (cus_id, receiver_name, receiver_phone, receiver_address, status_id, order_date, payment_method)
                                VALUES ($cus_id, '$cus_name', '$cus_phone', '$cus_add', 1, '$date',  $pay)";
                $query = mysqli_query($connect, $sqlInsertOrder);
                echo $sqlInsertOrder;


                //tao du lieu cho bang ord
                $ord_id = mysqli_insert_id($connect);
                foreach ($_SESSION['cart'][$cus_id] as $pr_id => $quantity) {
                    echo var_dump($quantity);
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
                header('Location:index.php');
            } else {
                $cus_id = $_SESSION['cust']['cus_id'];
                $ttall = 0;
                foreach ($_SESSION['cart'][$cus_id] as $pr_id => $quantity) {
                    $sqlProduct =   "SELECT * FROM product WHERE pr_id = $pr_id";
                    $querysqlProduct = mysqli_query($connect, $sqlProduct);
                    $product = mysqli_fetch_assoc($querysqlProduct);
                    $price = $product['pr_price'];
                    $quantity = $quantity['quantity'];
                    $total_price = $price *  $quantity;
                    $ttall += $total_price;
                }
                $_SESSION['totalAll'] = $ttall;
                $_SESSION['data'] = $_POST;
                // echo $ttall;
                require_once 'vnpay_create_payment.php';
            }
        }
    }
} else {
    header("location:login.php");
}
