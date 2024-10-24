<?php

// chuẩn bị câu truy vấn


if (isset($_POST["submit"])) {
    //kiểm tra xem đã nhập tên vào ô input hay chưa?
    if (empty($_POST['category'])) {
        $err['category_empty'] = "Category name cannot be blank!";
    } else {
        $categoryName = $_POST['category'];
    }


    if (isset($categoryName)) {

        //kiểm tra sự tồn tại của category mới
        $sqlCheckExists = "SELECT * FROM category WHERE name = '$categoryName'";
        $queryCheckExists = $connect->query($sqlCheckExists);
        $checkCategoryNotExists = true; //mặc định danh mục mới chưa có trong csdl
        if ($queryCheckExists->num_rows > 0) {
            $err['category_exists'] = "Category has been already!";
            $checkCategoryNotExists = false;
        }

        //Nếu category mới chưa tồn tại thì cho phép thêm vào csdl
        if (isset($categoryName) && $checkCategoryNotExists) {
            $sqlInsertCategory = "INSERT INTO category(name) VALUES ('$categoryName')";
            $queryInsertCategory = $connect->query($sqlInsertCategory);

            header('location:/web/admin/index.php?page_layout=category.php');
        }
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
            <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
        </div>
        <div class="card-body shadow">
            <form method="POST" action="">

                <div class="form-group">
                    <label for="formGroupExampleInput"><b>Name New Category:</b></label>
                    <!-- // hiển thị tên danh mục đã nhập value -->
                    <input type="text" name="category" style="width: 600px;" class="form-control" id="formGroupExampleInput" placeholder="Enter category name" value="<?php if (isset($categoryName)) echo $categoryName; ?>">
                    <span class="text-danger">
                        <?php
                        if (isset($err['category_empty'])) {
                            echo $err['category_empty'];
                        } else if (isset($err['category_exists'])) {
                            echo $err['category_exists'];
                        }
                        ?>
                    </span>
                </div>

                <div>
                    <button name="submit" type="submit" class="btn btn-success btn-sm">Add New</button>
                    <a href="/"><button type="button" class="btn btn-primary btn-sm">Restart</button></a>
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