<?php

$product = "";

//Kiểm tra khi submit có id product hay chưa? Nếu không có thì chuyển về trang danh sách sản phẩm.
if (!empty($_GET['pr_id'])) {
    $pr_id = $_GET['pr_id'];
    $query = "SELECT * FROM product WHERE pr_id = $pr_id";

    $queryProduct = $connect->query($query);
    $product = $queryProduct->fetch_assoc();
} else {
    header("location:/web/admin/index.php?page_layout=product.php");
}


if (isset($_POST['sbm'])) {
    //Kiểm tra khi submit có id product hay chưa? Nếu không có thì chuyển về trang danh sách sản phẩm.
    if (isset($_GET['pr_id'])) {
        $pr_id = $_GET['pr_id'];
    } else {
        header("location:/web/admin/index.php?page_layout=product");
    }

    $Outstanding = (!isset($_POST['outstanding'])) ? 0 : $_POST['outstanding'];
    //Image
    $Img = $_FILES['img_up']['name'];
    $target_dir = "uploads/img_product/";
    $target_file = "";
    $upload_error = array();
    if (!empty($_FILES['img_up']['name'])) {
        $target_file = $target_dir . basename($_FILES['img_up']['name']);

        $name = $_FILES['img_up']['name'];
        $tmp_name = $_FILES['img_up']['tmp_name'];
        $error = $_FILES['img_up']['error'];
        $size = $_FILES['img_up']['size'];
        $allowed_type = ['jpg', 'png', 'jpeg'];
        $extention = pathinfo($name, PATHINFO_EXTENSION);
        $max_size = 2 * 1024 * 1024;


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
    } else {
        $Img = $product['pr_image'];
    }

    if (empty($upload_error) && !empty($_FILES['img_up']['name'])) {
        move_uploaded_file($_FILES['img_up']['tmp_name'], $target_file);
    }

    // echo $Img;

    $sqlGetProducts = "UPDATE product SET pr_name = '{$_POST['name_up']}', pr_price = '{$_POST['price_up']}', 
                                pr_quantity = '{$_POST['quantity_up']}', length = '{$_POST['length_up']}', 
                                width = '{$_POST['width_up']}', 
                                height = '{$_POST['height_up']}', pr_image = '$Img', category_id = '{$_POST['cate_up']}',
                                status = '{$_POST['status_up']}', outstanding = '$Outstanding',
                                description = '{$_POST['des_up']}' WHERE pr_id = $pr_id ";


    $queryGetProducts = $connect->query($sqlGetProducts);
    header('location:/web/admin/index.php?page_layout=product.php');

    // var_dump($queryGetProducts);
    // echo $connect->error;
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
            <h6 class="m-0 font-weight-bold text-primary">Edit Product:</h6>
        </div>
        <div class="card-body shadow">

            <form class="row" action="index.php?page_layout=edit_product.php&pr_id=<?php echo $pr_id; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Name</b></label>
                        <input type="text" name="name_up" value="<?php echo $product['pr_name']; ?>" class="form-control" id="exampleFormControlInput1" placeholder="Lamp">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Price</b></label>
                        <input type="text" value="<?php echo $product['pr_price']; ?>" name="price_up" class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Quantity</b></label>
                        <input type="text" value="<?php echo $product['pr_quantity']; ?>" name="quantity_up" class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Length</b></label>
                        <input type="text" value="<?php echo $product['length']; ?>" name="length_up" class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Width</b></label>
                        <input type="text" value="<?php echo $product['width']; ?>" name="width_up" class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><b>Height</b></label>
                        <input type="text" value="<?php echo $product['height']; ?>" name="height_up" class="form-control" id="exampleFormControlInput1">
                    </div>

                </div>

                <div class="col-sm-7">

                    <div class="form-group mb-3">
                        <label for="exampleFormControlFile1"><b>Image Product</b></label>
                        <input name="img_up" value="<?php echo $product['pr_image'] ?>" type="file" class="form-control-file" onchange="previewImage();" id="exampleFormControlFile1">
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
                        <img src="uploads/img_product/<?php echo $product['pr_image']; ?>" class="img-fluid" id="prd_image" alt="..." width="100px" height="150px">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlFile1"><b>Category</b></label>
                        <select name="cate_up" class="form-control">
                            <?php

                            $slqGetCategories = "SELECT * FROM category";
                            // thực thi truy vấn
                            $queryGetCategories = $connect->query($slqGetCategories);

                            $rows = $queryGetCategories->fetch_all(MYSQLI_ASSOC);

                            foreach ($rows as $id => $row) {
                                // var_dump($row);
                                if ($row['id'] == $product['category_id']) { ?>
                                    <option selected value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                <?php
                                } else { ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>

                            <?php }
                            }

                            ?>

                        </select>

                        <label for="exampleFormControlFile1"><b>Status</b></label>
                        <select name="status_up" class="form-control">
                            <option value="1" <?php if ($product['status'] == 1) echo "selected"; ?>>Stocking</option>
                            <option value="0" <?php if ($product['status'] == 0) echo "selected"; ?>>Out of stock</option>
                        </select>
                    </div>


                    <div class="form-check mb-3">
                        <input name="outstand_up" class="form-check-input" type="checkbox" value="1" <?php
                                                                                                        if ($product['outstanding'] == 1) {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                        ?> id="defaultCheck1">
                        <label for="exampleFormControlFile1"><b>Outstanding products</b></label>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><b>Description </b></label>
                        <textarea name="des_up" value=" <?php echo $product['description']  ?>" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                    <button type="submit" name="sbm" class="btn btn-primary">Update</button>
                    <button type="submit" class="btn btn-success">Cancel</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<!-- Content Row -->


<!-- Content Row -->


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