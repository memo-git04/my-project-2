<?php
// chuẩn bị câu truy vấn
$sqlGetProducts = "SELECT * FROM product";
// thực thi truy vấn 
$queryGetProduct = $connect->query($sqlGetProducts);


$rows = $queryGetProduct->fetch_all(MYSQLI_ASSOC);


// print_r($rows);
$total = count($rows);

// echo $total;

$limit = 8;

$page = ceil($total / $limit);

$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
// echo $cr_page;

$start = ($cr_page - 1) * $limit;

$rows = mysqli_query($connect, "SELECT * FROM product LIMIT $start, $limit");




?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products Management</h1>
    </div>

    <!-- Content Row -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Products List</h6>
        </div>
        <div class="card-body shadow">
            <!-- Tables Products -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image Product</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Act</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // echo "<pre>";
                        // var_dump($rows);
                        // echo "</pre>";
                        $id = 1;
                        foreach ($rows as $value => $row) {
                            // if($row['isdeleted']){
                            //     echo '<span style="color:#AFA;">'.$row['isdeleted'];
                            // }

                            //  var_dump($rows);

                            if (!$row['isdeleted']) { ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $row['pr_name'] ?></td>
                                    <td><?= "$" . number_format($row['pr_price'], 2) ?></td>
                                    <td><img width="100px" height="120px" src="/web/admin/uploads/img_product/<?= $row['pr_image'] ?>" alt=""></td>
                                    <td>
                                        <?php if ($row['status'] == "1") {  ?>
                                            <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                Stocking
                                            </div>
                                        <?php } else { ?>
                                            <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                Out of Stocking
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php

                                        $slqGetCategories = "SELECT category.name FROM category
                                                                        INNER JOIN product 
                                                                        ON category.id = product.category_id
                                                                        WHERE category.id = {$row['category_id']}";
                                        // thực thi truy vấn
                                        $queryGetCategories = $connect->query($slqGetCategories);

                                        // var_dump($queryGetCategories);
                                        $results = $queryGetCategories->fetch_assoc();
                                        ?>
                                        <?php echo $results['name'] ?>

                                        <?php

                                        // }?
                                        ?>
                                    </td>



                                    <td>
                                        <a href="?page_layout=edit_product.php&pr_id=<?php echo $row['pr_id'] ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                        <a href="?page_layout=pr_isdeleted.php&pr_id=<?php echo $row['pr_id'] ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button></a>
                                    </td>
                                </tr>

                        <?php
                                $id += 1;
                            }
                        }
                        ?>



                    </tbody>
                </table>
                <!-- Button Add New Product -->
                <a href="/web/admin/index.php?page_layout=add_product.php"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add New Product</button></a>
            </div>
        </div>
    </div>
    <!-- Content Row -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- phan trang -->
<nav aria-label="Page navigation example" style="text-align: center; display:ruby;">
    <ul class="pagination">
        <?php
        if ($cr_page - 1 > 0) {
        ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page_layout=product.php&page=<?php echo $cr_page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php
        }
        ?>

        <?php
        for ($i = 1; $i <= $page; $i++) {
        ?>

            <li class="page-item <?php echo (($cr_page == $i) ? 'active' : " ") ?>"><a class="page-link" href="index.php?page_layout=product.php&page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php
        }
        ?>

        <?php
        if ($cr_page + 1 <= $page) {
        ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $cr_page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>

        <?php
        }
        ?>
    </ul>
</nav>

<!-- End of phan trang -->

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