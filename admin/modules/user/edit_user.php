<?php
if (isset($_POST["submit"])) {

    $sqlGetUpdateUser = "UPDATE users SET fullname = '{$_POST['update_name']}', email = '{$_POST['email']}', 
                                            phone = '{$_POST['phone']}', role={$_POST['level']}  
                                            WHERE user_id = '" . $_GET['user_id'] . "'";



    $queryGetUpdateUser = $connect->query($sqlGetUpdateUser);

    header('location:/web/admin/index.php?page_layout=user.php');

    // echo $queryGetUpdateUser;

}


if (isset($_GET['user_id'])) {
    $query = "SELECT * FROM users WHERE user_id='{$_GET['user_id']}'";

    $NewUser = $connect->query($query);
    $NewUser = $NewUser->fetch_assoc();
    // var_dump($NewUser);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Members List</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Member:</h6>
        </div>
        <div class="card-body shadow">
            <div class="row">
                <div class="col-sm-5">
                    <form action="" method="POST">
                        <div class="alert alert-warning" style="width: 600px;" role="alert">
                            Email already exists, Password does not match!
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Full Name</b></label>
                            <input type="text" name="update_name" value=" <?php echo $NewUser['fullname']  ?>" style="width: 600px;" class="form-control" id="exampleFormControlInput1" placeholder="Nguyen Thi Mai">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Email</b></label>
                            <input type="email" value="<?php echo $NewUser['email']  ?>" name="email" style="width: 600px;" class="form-control" id="exampleFormControlInput1" placeholder="email@gmail.com">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Phone</b></label>
                            <input type="text" value=" <?php echo $NewUser['phone']  ?>" name="phone" style="width: 600px;" class="form-control" id="exampleFormControlInput1">
                        </div>

                        <div>
                            <label for="exampleFormControlInput1"><b>Level</b></label>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="level" style="width: 600px;">
                                <option value="1">Admin</option>
                                <option value="0">Member</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            <a href=""><button type="submit" name="submit" class="btn btn-success">Add New</button></a>
                        </div>
                    </form>
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