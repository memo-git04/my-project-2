<?php
$title = "Cart";
ob_start();
session_start();
include_once "default/header.php";

$cusid = $_SESSION['cust']['cus_id'];

$sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE cus_id = $cusid";
// thực thi truy vấn
$queryGetOrders = mysqli_query($connect, $sqlGetOrders);


if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delivered') {
        $sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE o.status_id = 4";
        $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
    } else if ($_GET['status'] == 'Confirmed') {
        $sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE o.status_id = 2";
        $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
    } else if ($_GET['status'] == 'cancelled') {
        $sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE o.status_id = 5";
        $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
    }
}


if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $sqlOrder = "SELECT o.order_id, o.receiver_name, o.receiver_phone, o.receiver_address, 
                        SUM(ord.total_price * ord.quantity) as 'total_order', o.order_date, o.status_id 
                FROM orders o INNER JOIN order_detail ord
                on o.order_id = ord.order_id WHERE o.order_id = $order_id";
    // thực thi truy vấn
    $queryOrder = mysqli_query($connect, $sqlOrder);
    $resultOrder = mysqli_fetch_assoc($queryOrder);


    // $order_id = $_GET['id'];                                                                                                             
    // } else {
    //     // header("location: index.php?page_layout=order.phsp");
    // }
    //thong tin chi tieets don hang
    $sqlGetOrderDetail = "SELECT ord.quantity, ord.price, p.pr_name, p.pr_image FROM orders o
                        INNER JOIN order_detail ord ON o.order_id = ord.order_id 
                        INNER JOIN product p ON ord.pr_id = p.pr_id
                        WHERE o.order_id = $order_id";
    $queryGetOrdDetail = mysqli_query($connect, $sqlGetOrderDetail);
}


if (isset($_SESSION['error_cancel_order_cust'])) {
    unset($_SESSION['error_cancel_order_cust']);
}



?><!-- product cards -->




<div class="container" id="cart">
    <div class="row">
        <div class="text-center">
            <h3>Your order</h3>
        </div>
    </div>

    <div class="row mt-5">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <td>
                        <a href="?status=delivered"><button type="button" class="btn btn-warning btn-sm">Order is being delivered</button></a>
                        <a href="?status=Confirmed"><button type="button" class="btn btn-success btn-sm">Order has been Confirmed</button></a>
                        <a href="?status=cancelled"><button type=" button" class="btn btn-danger btn-sm">Order has been cancelled</button></a>
                    </td>
                </div>
                <table class="table  table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Total order</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($order = mysqli_fetch_assoc($queryGetOrders)) {
                            // echo "<pre>";
                            // print_r($order);

                        ?>
                            <tr>
                                <td><?php echo $order['order_id'] ?></td>
                                <td><?php echo $order['receiver_name'] ?></td>
                                <td><?php echo '$' . number_format($order['total_order'], 0, '', '.')  ?></td>
                                <td><?php echo $order['order_date'] ?></td>
                                <td>
                                    <span class="text text-primary">
                                        <?php

                                        $slqGetStatus = "SELECT status.status_name FROM status
                                        INNER JOIN orders 
                                        ON status.status_id = orders.status_id
                                        WHERE status.status_id = {$order['status_id']}";
                                        // thực thi truy vấn
                                        $queryGetStatus = $connect->query($slqGetStatus);
                                        $result = $queryGetStatus->fetch_assoc();
                                        ?>

                                        <?php echo $result['status_name'] ?>

                                    </span>

                                </td>
                                <td>
                                    <a href="order_detail_cust.php?id=<?php echo $order['order_id'] ?>">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetail">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>


                                </td>
                            </tr>
                        <?php
                        }
                        ?>



                    </tbody>



                </table>
            </div>
        </div>
    </div>




</div>
<!-- product cards -->




<a href="#" class="arrow"><i><img src="./images/arrow.png" alt=""></i></a>

<?php
include_once "default/footer.php";
?>