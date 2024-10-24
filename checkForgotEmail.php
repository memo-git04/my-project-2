<?php
include_once "admin/config/db.php";

$connect = doConnection();

session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Store</title>
    <link rel="stylesheet" href="./css1/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <!-- fonts links -->
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

        .form-group input {
            border-radius: 50px;
        }

        #input1 {
            margin-bottom: 10px;
        }
    </style>
    <link href="../Web/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../Web/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img style="width: 455px; height: 600px;" src="./image/pic_2.jpg" alt="">
                            </div>

                            <div class="col-lg-6">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <form action="Mailer.php" class="user" method="post">

                                        <div id="input1" class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="input" placeholder="@gmail.com">
                                        </div>

                                        <span class="text-danger text-err">
                                            <?php
                                            if (isset($_SESSION['email_empty']) && !empty($_SESSION['email_empty'])) {
                                                echo 'Email not empty';
                                                $_SESSION['email_empty'] = '';
                                            }
                                            ?>
                                        </span>


                                        <!-- <button> -->
                                        <button id="button" name="ForgotPassword" value="login" type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>





    <a href="#" class="arrow"><i><img src="./images/arrow.png" alt=""></i></a>



    <!-- Bootstrap core JavaScript-->
    <script src="../Web/admin/vendor/jquery/jquery.min.js"></script>
    <script src="../Web/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../Web/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../Web/admin/js/sb-admin-2.min.js"></script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- check -->
    <!-- <script>
        var Input = document.getElementById('input')
        var submit = document.getElementById('button')
        Input.onchange = function() {
            submit.removeAttribute('disabled')
        }
        if (Input.value == "") {
            submit.setAttribute("", "disabled")
        }
    </script> -->

</body>

</html>