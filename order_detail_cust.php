<?php
ob_start();
session_start();
$title = "Product - Detail";
include_once "default/header.php";

$order_id = $_GET['id'];

$sql = "SELECT * FROM orders WHERE order_id = $order_id AND status_id = 1";
$query = mysqli_query($connect, $sql);
$count = mysqli_num_rows($query);
if ($count > 0) {
    unset($_SESSION['error_cancel_order_cust']);
}

if (isset($_GET['action'])) {
    //check status của order theo order_id 
    //Nếu trạng thái là Confirm, Intransit, Cancel => thì không cho hủy
    $sql = "SELECT * FROM orders WHERE order_id = $order_id AND status_id IN (2,3,4,5)";
    $query = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $_SESSION['error_cancel_order_cust'] = "Đơn hàng đã được tiếp nhận. Không thể hủy đơn hàng";
        header("location:order_detail_cust.php?id=$order_id");
    } else {
        //Nếu trạng thái là Chờ xác nhận thì mới cho hủy
        $sqlCancel = "UPDATE orders SET status_id = 5 WHERE order_id = $order_id";
        $query = mysqli_query($connect, $sqlCancel);
        //...
        header("location:order_detail_cust.php?id=$order_id");
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


    //thong tin chi tieets don hang
    $sqlGetOrderDetail = "SELECT ord.quantity, ord.price, p.pr_name, p.pr_image FROM orders o
                        INNER JOIN order_detail ord ON o.order_id = ord.order_id 
                        INNER JOIN product p ON ord.pr_id = p.pr_id
                        WHERE o.order_id = $order_id";
    $queryGetOrdDetail = mysqli_query($connect, $sqlGetOrderDetail);
}
?>
<!-- Massage Completed the order -->
<div class="container" id="cart">
    <!-- <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> -->
    <div class="row">
        <div class="text-center">
            <h3>Your order detail</h3>
        </div>
    </div>
    <div class="mt=5">
        <span class="mt-5 text text-danger">
            <?php
            if (isset($_SESSION['error_cancel_order_cust'])) {
                echo $_SESSION['error_cancel_order_cust'];
            }
            ?>
        </span>
    </div>
    <div class="card">
        <div class="row mt-5">
            <div class="card-body">
                <table class="table  table-striped table-hover">
                    <!-- <div class="modal-body p-lg-4"> -->
                    <h5>Order Detail</h5>
                    <hr>
                    <p>Order ID: <?php echo $resultOrder['order_id'] ?></p>
                    <p>Customer: <?php echo $resultOrder['receiver_name'] ?></p>
                    <p>Phone: <?php echo $resultOrder['receiver_phone'] ?></p>
                    <p>Address: <?php echo $resultOrder['receiver_address'] ?></p>


                    <p>Order Date: <?php echo $resultOrder['order_date'] ?></p>
                    <p>Status:
                        <span class="text text-primary">

                            <?php

                            $slqGetStatus = "SELECT status.status_name FROM status
                                                                        INNER JOIN orders 
                                                                        ON status.status_id = orders.status_id
                                                                        WHERE status.status_id = {$resultOrder['status_id']}";
                            // thực thi truy vấn
                            $queryGetStatus = $connect->query($slqGetStatus);

                            // echo "<pre>";
                            // print_r($queryGetStatus);
                            $result = $queryGetStatus->fetch_assoc();
                            ?>
                            <?php echo $result['status_name'] ?>

                        </span>
                    </p>
                    <hr>
                    <div class="row">
                        <h4 class="text">Product</h4>
                        <table class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Img</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($detail = mysqli_fetch_assoc($queryGetOrdDetail)) {
                                    // echo "<pre>";
                                    // print_r($detail);
                                ?>
                                    <tr>
                                        <td>
                                            <img width="70px" height="100px" style="width: 100px;" src="admin/uploads/img_product/<?php echo $detail['pr_image'] ?>" alt="">
                                        </td>
                                        <td><?php echo $detail['pr_name'] ?></td>
                                        <td><?php echo number_format($detail['price'], 0, '', '.') ?></td>
                                        <td>
                                            <?php echo $detail['quantity'] ?>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-md-end me-3">
                        <p class="text-danger" style="margin-right: 155px">Total price: $123.000</p>
                    </div>

                </table>
            </div>
        </div>
        <div>
            <a href="ord_detail.php"><button style="margin-left: 1000px; margin-top: 10px;" type="button" class="btn btn-success">Ok</button></a>
            <!-- Button trigger modal -->

            <?php
            if (!isset($_SESSION['error_cancel_order_cust'])) {

            ?>
                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Huy don hang
                </button>
            <?php } ?>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="order_detail_cust.php?id=<?php echo $resultOrder['order_id'] ?>&action=cancel"><button type="button" class="btn btn-primary">Huy</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    include_once "default/footer.php";
    ?>