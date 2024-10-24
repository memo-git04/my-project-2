<?php
include_once "admin/config/db.php";
$connect = doConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?> </title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />
    <!-- fonts links -->
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- top navbar -->
    <div class="top-navbar">
        <p>WELCOME TO MY SHOP!</p>
        <div class="icons" style="display:-webkit-inline-box;">
            <div class="dropdown">
                <?php
                if (!empty($_SESSION['cust'])) {
                    echo $_SESSION['cust']['firstname'] . ' ' . $_SESSION['cust']['lastname'];
                }
                ?>
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php
                    if (isset($_SESSION['cust'])) {
                    ?>
                        <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-right-to-bracket mx-1"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="ord_detail.php"><i class="fa-solid fa-right-to-bracket mx-1"></i>Order</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-to-bracket mx-1"></i>Logout</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a class="dropdown-item" href="login.php"><i class="fa-solid fa-user mx-1"></i> Login</a></li>
                        <li><a class="dropdown-item" href="register.php"><i class="fa-solid fa-id-card mx-1"></i>Register</a></li>
                    <?php
                    }
                    ?>
                </ul>

            </div>



            <div style="font-size: 29px; margin-right: 5px;">
                <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping">

                        <!-- <span class="badge badge-danger badge-counter">3+</span> -->
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="z-index: 0; font-size: 12px;" class="badge badge-danger rounded-pill">
                            <?php
                            if (!empty($_SESSION['cart'])) {
                                echo count($_SESSION['cart']);
                            } else {
                                echo 0;
                            }
                            ?>
                            <span class="visually-hidden">unread messages</span>


                        </span>
                    </i>
                </a>
            </div>

        </div>
    </div>
    <!-- top navbar -->

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo"><span id="span1">F</span>urniture <span>Shop</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rosybrown">
                            <?php
                            $sqlGetCategory = "SELECT name FROM category";
                            $queryGetCategory = $connect->query($sqlGetCategory); //goi theo phuong thuc

                            while ($result = $queryGetCategory->fetch_assoc()) {
                            ?>

                                <li>
                                    <a class="dropdown-item" href="category_product.php?category=<?php echo $result['name'] ?>"><?php echo $result['name'] ?></a>
                                </li>


                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" id="search" action="search.php" method="get">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- navbar -->