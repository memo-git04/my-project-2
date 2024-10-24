<?php
session_start();
include_once "config/db.php";

$conn = doConnection();


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Login</title>

    <style>
        #button {
            border-radius: 50px 50px 50px 50px;
            width: 345px;
            height: 50px;
        }

        #button1 {
            border-radius: 50px 50px 50px 50px;
            width: 345px;
            height: 50px;
            margin-bottom: 10px;
        }
    </style>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img style="width: 455px; height: 600px;" src="img/pic_2.jpg" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <?php

                                    // chuẩn bị câu truy vấn
                                    $Cus = "";
                                    if (isset($_POST['login'])) {
                                        $sqlGetAllCus = "SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'";
                                        // thực thi truy vấn
                                        $queryGetAllCus = mysqli_query($conn, $sqlGetAllCus);

                                        $Cus =  $queryGetAllCus->fetch_assoc();

                                        // var_dump($queryGetAllCus);
                                        // var_dump($Cus);

                                        if (isset($Cus)) {
                                            $_SESSION['email'] = $Cus['email'];
                                            $_SESSION['name'] = $Cus['fullname'];
                                            $_SESSION['id'] = $Cus['user_id'];
                                            header('location:/web/admin/index.php?page_layout=admin.php');
                                        } else {
                                            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div>
                                                    Email or Password error!
                                                </div>
                                                </div>';
                                        }
                                    }
                                    ?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" value="<?php
                                                                        $emailPost = (empty($_POST['email'])) ? "" : $_POST['email'];
                                                                        echo $emailPost;
                                                                        ?>" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>

                                        <!-- <button> -->

                                        <button id="button" name="login" value="login" type="submit" class="btn btn-primary">Login</button>

                                        <hr>
                                        <button id="button1" name="submit" type="submit" class="btn btn-danger"><i class="fab fa-google fa-fw"></i> Login with Google</button>
                                        <br>
                                        <button id="button" name="submit" type="submit" class="btn btn-success"><i class="fab fa-facebook-f fa-fw"></i> Login with Facebook</button>
                                        <!-- <button> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>