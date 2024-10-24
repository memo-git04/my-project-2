<?php
// chuẩn bị câu truy vấn
$sqlGetAllUsers = "SELECT * FROM users";
// thực thi truy vấn
$queryGetAllUsers = mysqli_query($connect, $sqlGetAllUsers);

if (isset($_GET['user_id'])) {
    $isDeleted = "UPDATE users SET isdeleted = 1 WHERE user_id={$_GET['user_id']}";
    $isDeleted = $connect->query($isDeleted);
    header('location:/web/admin/index.php?page_layout=user.php');
}


?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Members Management</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Members List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Level</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($result = mysqli_fetch_assoc($queryGetAllUsers)) {
                            if (!$result['isdeleted']) {
                        ?>

                                <tr>
                                    <td> <?php echo $result['user_id'] ?> </td>
                                    <td><?php echo $result['fullname'] ?></td>
                                    <td><?php echo $result['email'] ?></td>

                                    <td><?php echo $result['phone'] ?></td>
                                    <td>
                                        <?php
                                        if ($result['role']) { ?>
                                            <button type="button" class="btn btn-success btn-sm">
                                                Admin
                                            </button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-primary btn-sm">
                                                Member
                                            </button>
                                        <?php
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="?page_layout=edit_user.php&user_id=<?php echo $result['user_id'] ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                        <!-- <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button></a> -->

                                        <a href="?page_layout=user.php&user_id=<?php echo $result['user_id'] ?>"><button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button></a>
                                    </td>

                                </tr>

                        <?php

                            }
                        }
                        ?>

                    </tbody>
                </table>

                <!-- Button Add New Product -->
                <a href="?page_layout=add_user.php"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add New Member</button></a>
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