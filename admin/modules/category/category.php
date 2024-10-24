<?php

// chuẩn bị câu truy vấn
$slqGetCategories = "SELECT * FROM category";
// thực thi truy vấn
$queryGetCategories = $connect->query($slqGetCategories);

if (isset($_GET['id'])) {
    $isDeleted = "UPDATE category SET isdeleted = 1 WHERE id={$_GET['id']}";
    $isDeleted = $connect->query($isDeleted);
    header('location:/web/admin/index.php?page_layout=category.php');
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categories Management</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name Category</th>
                            <th>Act</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        while ($row = $queryGetCategories->fetch_assoc()) {

                            if (!$row['isdeleted']) {


                        ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td>
                                        <a href="?page_layout=edit_category.php&id=<?php echo $row['id'] ?>">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>

                                        <a href="?page_layout=category.php&id=<?php echo $row['id'] ?>">
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>

                <div>
                    <a href="?page_layout=add_category"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add New</button></a>

                </div>
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