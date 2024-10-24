<?php
// chuẩn bị câu truy vấn
// if (isset($_GET['order_id'])) {

//     $order_id = $_GET['id'];
// } else {
//     header("location: index.php?page_layout=order.php");
// }   
$sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id";
// thực thi truy vấn
$queryGetOrders = mysqli_query($connect, $sqlGetOrders);

// echo "<pre>";
// print_r($queryGetOrders);



// echo "<pre>";
// print_r($queryGetStatus);



if (isset($_GET['status'])) {
    if ($_GET['status'] == 'Delivered') {
        $sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE o.status_id = 4";
        $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
    } else if ($_GET['status'] == 'Confirmed') {
        $sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE o.status_id = 2";
        $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
    } else if ($_GET['status'] == 'Cancelled') {
        $sqlGetOrders = "SELECT o.order_id, o.receiver_name,(ord.price * ord.quantity) as 'total_order', o.order_date, o.status_id FROM orders o INNER JOIN order_detail ord on o.order_id = ord.order_id WHERE o.status_id = 5";
        $queryGetOrders = mysqli_query($connect, $sqlGetOrders);
    }
}



// da giao hàng thi khong cho huy
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Orders Management <b><span class="text"></span></b></h1>
    <span class="text text-danger">
        <?php
        if (isset($_SESSION['err_update_status'])) {
            echo $_SESSION['err_update_status'];
            unset($_SESSION['err_update_status']);
        }
        ?>
    </span>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <td>
                        <a href="?page_layout=order.php&status=delivered"><button type="button" class="btn btn-warning btn-sm">Order is being Delivered</button></a>
                        <a href="?page_layout=order.php&status=Confirmed"><button type="button" class="btn btn-success btn-sm">Order has been Confirmed</button></a>
                        <a href="?page_layout=order.php&status=cancelled"><button type=" button" class="btn btn-danger btn-sm">Order has been Cancelled</button></a>
                    </td>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    <a href="index.php?page_layout=order_detail.php&id=<?php echo $order['order_id'] ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                    <a href="index.php?page_layout=update_ord.php&id=<?php echo $order['order_id'] ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    <a href="index.php?page_layout=order_detail.php&id=<?php echo $order['order_id'] ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button></a>
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
<!-- /.container-fluid  End-->

</div>
<!-- End of Main Content -->

<!-- Footer -->

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

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