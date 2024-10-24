<?php



$NewCategory = "";

if (isset($_GET['id'])) {
    // $query = "SELECT * FROM category WHERE id ='".$_GET['id']."'";
    //SELECT * FROM category WHERE id ='$'
    $query = "SELECT * FROM category WHERE id ='{$_GET['id']}'";

    $NewCategory = $connect->query($query);
    $NewCategory = $NewCategory->fetch_assoc();
}

$err['err'] = "";
if (isset($_POST['update_category'])) {
    if ($_POST['update_category'] == $NewCategory['name']) {
        $err['err'] = '<div class="alert alert-warning" style="width: 600px;" role="alert">
        Category already exists!
        </div>';
    } else {
        $slqGetCategories = "UPDATE category SET name = '" . $_POST['update_category'] . "' WHERE id = '" . $_GET['id'] . "'";

        $queryGetCategories = $connect->query($slqGetCategories);

        header('location:/web/admin/index.php?page_layout=category.php');
    }
}


?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categories Management</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
        </div>
        <div class="card-body shadow">
            <form method="post" action="">
                <?php
                if (isset($err['err'])) {
                    echo $err['err'];
                }
                ?>

                <div class="form-group">
                    <label for="formGroupExampleInput"><b>Category 1:</b></label>
                    <input type="text" value="<?php echo $NewCategory['name'] ?>" name="update_category" style="width: 600px;" class="form-control" id="formGroupExampleInput" placeholder="Table">
                </div>

                <div>
                    <button type="submit" name="submit" class="btn btn-success btn-sm">UpDate</button>
                    <a href="?page_layout=add_category.php"><button type="button" class="btn btn-primary btn-sm">Add New</button></a>
                </div>
            </form>
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