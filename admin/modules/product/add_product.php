<?php
// THIẾU VALIDATE name, price , quantity
if (isset($_POST["submit"])) {

    $Cate = $_POST['cate'];
    $Status = $_POST['status'];
    $Outstanding = (!isset($_POST['outstanding'])) ? 0 : $_POST['outstanding'];
    $Description = $_POST['descript'];

    //valide
    if (empty($_POST['name'])) {
        $err['name_empty'] = "Name cannot be blank!";
    } else {
        $Name = $_POST['name'];
    }

    if (empty($_POST['price'])) {
        $err['price_empty'] = "Price cannot be blank!";
    } else {
        $Price = $_POST['price'];
    }

    if (empty($_POST['quantity'])) {
        $err['qty_empty'] = "Quantity cannot be blank!";
    } else {
        $Quantity = $_POST['quantity'];
    }

    if (empty($_POST['length'])) {
        $err['length_empty'] = "Length cannot be blank!";
    } else {
        $Length = $_POST['length'];
    }

    if (empty($_POST['width'])) {
        $err['width_empty'] = "Width cannot be blank!";
    } else {
        $Width = $_POST['width'];
    }

    if (empty($_POST['width'])) {
        $err['height_empty'] = "Height cannot be blank!";
    } else {
        $Height = $_POST['height'];
    }



    // upload Img
    $name = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $error = $_FILES['img']['error'];
    $size = $_FILES['img']['size'];
    $allowed_type = ['jpg', 'png', 'jpeg'];
    $extention = pathinfo($name, PATHINFO_EXTENSION);
    $upload_error = array();
    $max_size = 2 * 1024 * 1024;

    $target_dir = "uploads/img_product/";
    $target_file = $target_dir . basename($_FILES['img']['name']);

    //check
    if ($error > 0) {
        $upload_error['upload_error'] = "Upload File Process error!";
    }

    if (!in_array($extention, $allowed_type)) {
        $upload_error['file_extenstion'] = "You only can upload file .jpg, .jpeg, .png!";
    }

    if ($size > $max_size) {
        $upload_error['size_error'] = "File upload not over 2Mb!";
    }

    // echo $target_file;
    if (empty($upload_error)) {
        move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
        $slqGetProducts = "INSERT INTO product(pr_name, pr_price, pr_quantity, length, width, height, pr_image, category_id, status, outstanding, description) 
                            VALUES ('$Name', '$Price', '$Quantity', '$Length', '$Width', '$Height', '$name', '$Cate', $Status, '$Outstanding', '$Description')";
        $queryGetProducts = $connect->query($slqGetProducts);
        header('location:/web/admin/index.php?page_layout=product.php');
    }

    // echo "$Img";
    // echo $connect->error;

    // var_dump($queryGetProducts);

}


?>
<!-- End of Topbar -->

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
            <h6 class="m-0 font-weight-bold text-primary">Add New Product:</h6>
        </div>
        <div class="card-body shadow">

            <form class="row" action="" method="POST" enctype="multipart/form-data">
                <div class="col-sm-5">

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Name</b></label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
                        <span class="text-danger">
                            <?php
                            if (isset($err['name_empty'])) {
                                echo $err['name_empty'];
                            }

                            ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Price</b></label>
                        <input type="text" name="price" class="form-control" id="exampleFormControlInput1">
                        <span class="text-danger">
                            <?php
                            if (isset($err['price_empty'])) {
                                echo $err['price_empty'];
                            }

                            ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Quantity</b></label>
                        <input type="text" name="quantity" class="form-control" id="exampleFormControlInput1">
                        <span class="text-danger">
                            <?php
                            if (isset($err['qty_empty'])) {
                                echo $err['qty_empty'];
                            }

                            ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Length</b></label>
                        <input type="text" name="length" class="form-control" id="exampleFormControlInput1">
                        <span class="text-danger">
                            <?php
                            if (isset($err['length_empty'])) {
                                echo $err['length_empty'];
                            }

                            ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Width</b></label>
                        <input type="text" name="width" class="form-control" id="exampleFormControlInput1">
                        <span class="text-danger">
                            <?php
                            if (isset($err['width_empty'])) {
                                echo $err['width_empty'];
                            }

                            ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Height</b></label>
                        <input type="text" name="height" class="form-control" id="exampleFormControlInput1">
                        <span class="text-danger">
                            <?php
                            if (isset($err['height_empty'])) {
                                echo $err['height_empty'];
                            }

                            ?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlFile1"><b>Image Product</b></label>
                        <input name="img" value="" type="file" class="form-control-file" onchange="previewImage();" id="exampleFormControlFile1">
                        <span class="text-danger">
                            <?php
                            if (isset($upload_error['upload_error'])) {
                                echo $upload_error['upload_error'];
                            } else if (isset($upload_error['file_extenstion'])) {
                                echo $upload_error['file_extenstion'];
                            } else if (isset($upload_error['size_error'])) {
                                echo $upload_error['size_error'];
                            }
                            ?>
                        </span>

                    </div>

                    <div class="mb-3">
                        <img src="img/no-images.png" class="img-fluid" id="prd_image" alt="..." width="100px" height="150px">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlFile1"><b>Category</b></label>
                        <select name="cate" class="form-control">
                            <?php

                            $slqGetCategories = "SELECT * FROM category";
                            // thực thi truy vấn
                            $queryGetCategories = $connect->query($slqGetCategories);

                            $rows = $queryGetCategories->fetch_all(MYSQLI_ASSOC);

                            foreach ($rows as $id => $row) {
                                if ($row) { ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                                }
                            }

                            ?>

                        </select>

                        <label for="exampleFormControlFile1"><b>Status</b></label>
                        <select name="status" class="form-control">
                            <option value="1">Stocking</option>
                            <option value="0">Out of stock</option>
                        </select>
                    </div>

                    <label for="exampleFormControlFile1"><b>Outstanding products</b></label>
                    <div class="form-check">
                        <input name="outstanding" class="form-check-input" type="checkbox" value="1" id="defaultCheck1">

                        <label class="form-check-label" for="defaultCheck1">
                            OutStanding
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><b>Description </b></label>
                        <textarea name="descript" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success">Add New</button>
                </div>
                <!-- End Form -->
        </div>
        </form>
    </div>
</div>
<!-- Content Row -->

<div class="row">




</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->


</div>

</div>
<!-- /.container-fluid -->

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

<script>
    function previewImage() {
        prd_image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>