<?php

if (isset($_POST['submit'])) {

    $userPhone = $_POST['phone'];
    $userLevel = $_POST['level'];
    // kiem tra du lieu nhap vao o input hay chua
    if (empty($_POST['name'])) {
        $errInput['name_empty'] = 'Fullname cannot be blank!';
    } else {
        $userName = $_POST['name']; // neu dax nhap ten thi tao bien $userFull
    }

    if (empty($_POST['email'])) {
        $errInput['email_empty'] = 'Email cannot be blank!';
    } else {
        $userMail = $_POST['email']; // neu dax nhap ten thi tao bien $userFull
    }

    if (empty($_POST['password'])) {
        $errInput['pass_empty'] = 'Password cannot be blank!';
    } else {
        $userPassword = $_POST['password']; // neu dax nhap ten thi tao bien $userFull
    }

    if (empty($_POST['repassword'])) {
        $errInput['repass_empty'] = 'Repassword cannot be blank!';
    } else {
        $userRePass = $_POST['repassword']; // neu dax nhap ten thi tao bien $userFull
    }

    if (empty($_POST['phone'])) {
        $errInput['phone_empty'] = 'Phone cannot be blank!';
    } else {
        $userRePass = $_POST['phone']; // neu dax nhap ten thi tao bien $userFull
    }

    // kiem tra mat khau co khop nhau 
    //phuong phap dat cow hieu
    $checkPasswordCheck = true;
    if (isset($userPassword) && isset($userRePass)) {
        if ($userPassword != $userRePass) {
            $errInput['pass-not-match'] = 'Password incorrect!';
            $checkPasswordCheck = false;
        }
    }
    // kiem tra su ton tai cua email
    $checkEmailNotExsist = true; // gia su Email nhap vao chuaw ton tai
    if (isset($userMail)) {
        $sqlCheckEmailExsists = "SELECT * FROM users WHERE email = '$userMail' ";
        $queryCheckEmailExsists = mysqli_query($connect, $sqlCheckEmailExsists);
        if (mysqli_num_rows($queryCheckEmailExsists) > 0) {
            $errInput['email_exists'] = '<div class="mt-2 alert alert-warning" style="width: 600px;" role="alert">
                        Email already exists!
                        </div>';
            $checkEmailNotExsist = false;
        }
    }


    // them moi  vao csdl
    if (isset($userName) && isset($userMail) && isset($userPassword) && $checkPasswordCheck && $checkEmailNotExsist) {
        $sqlInsertUser = "INSERT INTO users (fullname, email, password, phone, role )
                    VALUES ('$userName', '$userMail', '$userPassword', '$userPhone', $userLevel)";
        $queryInsertUser = $connect->query($sqlInsertUser);

        // echo $queryInsertUser;
        // var_dump($queryInsertUser);
        if ($queryInsertUser) {
            header('location:/web/admin/index.php?page_layout=user.php');
        }
    }
}

//}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Members List</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Member:</h6>
        </div>
        <div class="card-body shadow">
            <div class="row">
                <div class="col-sm-5">
                    <form action="" method="POST">


                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Full Name</b></label>
                            <input type="text" name="name" style="width: 600px;" class="form-control" id="exampleFormControlInput1" value="<?php if (isset($userName)) echo $userName ?>">
                            <span class="text-danger">
                                <?php
                                if (isset($errInput['name_empty'])) {
                                    echo $errInput['name_empty'];
                                }
                                // else if (isset($errInput['name_exists'])) {
                                //     echo $errInput['name_exists'];
                                // }
                                ?>
                            </span>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Email</b></label>
                            <input type="email" name="email" style="width: 600px;" class="form-control" id="exampleFormControlInput1" value="<?php if (isset($userMail)) echo $userMail ?>">
                            <span class="text-danger">
                                <?php
                                if (isset($errInput['email_empty'])) {
                                    echo $errInput['email_empty'];
                                } else if (isset($errInput['email_exists'])) {
                                    echo $errInput['email_exists'];
                                }
                                ?>
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Password</b></label>
                            <input type="password" name="password" style="width: 600px;" class="form-control" id="exampleFormControlInput1">
                            <span class="text-danger">
                                <?php
                                if (isset($errInput['pass_empty'])) {
                                    echo $errInput['pass_empty'];
                                }

                                ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Re-Password</b></label>
                            <input type="password" name="repassword" style="width: 600px;" class="form-control" id="exampleFormControlInput1">
                            <span class="text-danger">
                                <?php
                                if (isset($errInputInput['repass_empty'])) {
                                    echo $errInputInput['repass_empty'];
                                }

                                ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><b>Phone</b></label>
                            <input type="text" name="phone" style="width: 600px;" class="form-control" id="exampleFormControlInput1">

                            <span class="text-danger">
                                <?php
                                if (isset($errInput['phone_empty'])) {
                                    echo $errInput['phone_empty'];
                                }

                                ?>
                            </span>
                        </div>

                        <div>
                            <label for="exampleFormControlInput1"><b>Level</b></label>
                        </div>
                        <div class="form-group">
                            <select name="level" class="form-control" style="width: 600px;">
                                <option value="1">Admin</option>
                                <option value="0">Member</option>
                            </select>
                        </div>

                        <div>
                            <button name="submit" type="submit" class="btn btn-success">Add New</button>
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