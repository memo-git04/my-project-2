<?php
// chuẩn bị câu truy vấn





$order_id = $_GET['id'];


// thong tin don hanf
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

// thực thi truy vấn
// $queryDetail = mysqli_query($connect, $sqlGetOrderDetail);
// $queryDetail2 = mysqli_query($connect, $sqlGetOrderDetail);
// $resultOrder = mysqli_fetch_assoc($queryDetail2);
// var_dump($resultDetail);




// da giao hàng thi khong cho huy
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders Management</h1>
    </div>

    <!-- Content Row -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Detail:</h6>
        </div>
        <div class="card-body shadow">

            <form class="row" action="" method="POST" enctype="multipart/form-data">



                <div class="col-sm-6">
                    <label for="exampleFormControlInput1"><b>Customer information</b></label>
                    <hr>
                    <p>Order ID: <?php echo $resultOrder['order_id'] ?></p>
                    <p>Customer: <?php echo $resultOrder['receiver_name'] ?></p>
                    <p>Phone: <?php echo $resultOrder['receiver_phone'] ?></p>
                    <p>Address: <?php echo $resultOrder['receiver_address'] ?></p>
                    <p>Total order: <?php echo number_format($resultOrder['total_order'], '0', '', '.') ?> </p>
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
                </div>







                <div class="col-sm-12">
                    <label for="exampleFormControlInput1"><b>Product information</b></label>
                </div>
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Img</th>
                                <th style="width: 450px;">Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
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
                                        <img width="70px" height="100px" src="uploads/img_product/<?php echo $detail['pr_image'] ?>" alt="">
                                    </td>
                                    <td><?php echo $detail['pr_name'] ?></td>
                                    <td><?php echo $detail['quantity'] ?></td>
                                    <td><?php echo number_format($detail['price'], 0, '', '.') ?></td>
                                </tr>
                            <?php
                            }

                            ?>

                            <hr>

                        </tbody>

                    </table>
                </div>

                <!-- End Form -->
        </div>
        </form>
    </div>
</div>
<!-- Content Row -->

<div class="row" style="margin-left: 15px;">
    <div class="col-md-12">
        <a href="index.php?page_layout=update_ord.php&id=<?php echo $resultOrder['order_id'] ?>" type="button" class="btn btn-success">Update</a>

        <a href="index.php?page_layout=order.php" type="button" class="btn btn-success">Back to</a>
    </div>

</div>

<!-- Content Row -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>