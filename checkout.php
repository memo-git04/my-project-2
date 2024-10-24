<?php
session_start();
$title = "Checkout";
include_once "default/header.php";

include_once "admin/config/db.php";
$connect = doConnection();


$pr_id_list = "";
$cus_id = $_SESSION['cust']['cus_id'];
foreach ($_SESSION['cart'][$cus_id] ?? [] as $key => $value) {
    $pr_id_list .= $key . ",";
}

// echo $pr_id_list;

$pr_id_list = rtrim($pr_id_list, ","); // cat dau , trong chuoi
$pr_id_list = '(' . $pr_id_list . ')';

// echo $pr_id_list;

$sqlGetInCart = "SELECT * FROM product WHERE pr_id IN $pr_id_list";
$queryGetInCart = mysqli_query($connect, $sqlGetInCart);
// $queryGetCart = mysqli_fetch_assoc($queryGetInCart);





// var_dump($queryGetCart);
// print_r($queryGetCart);



?><!-- product cards -->

<style>
    .check-out__btn {
        position: fixed;
        bottom: 66px;
        right: 142px;
    }

    .modal#statusSuccessModal .modal-content,
    .modal#statusErrorsModal .modal-content {
        border-radius: 30px;
    }

    .modal#statusSuccessModal .modal-content svg,
    .modal#statusErrorsModal .modal-content svg {
        width: 100px;
        display: block;
        margin: 0 auto;
    }

    .modal#statusSuccessModal .modal-content .path,
    .modal#statusErrorsModal .modal-content .path {
        stroke-dasharray: 1000;
        stroke-dashoffset: 0;
    }

    .modal#statusSuccessModal .modal-content .path.circle,
    .modal#statusErrorsModal .modal-content .path.circle {
        -webkit-animation: dash 0.9s ease-in-out;
        animation: dash 0.9s ease-in-out;
    }

    .modal#statusSuccessModal .modal-content .path.line,
    .modal#statusErrorsModal .modal-content .path.line {
        stroke-dashoffset: 1000;
        -webkit-animation: dash 0.95s 0.35s ease-in-out forwards;
        animation: dash 0.95s 0.35s ease-in-out forwards;
    }

    .modal#statusSuccessModal .modal-content .path.check,
    .modal#statusErrorsModal .modal-content .path.check {
        stroke-dashoffset: -100;
        -webkit-animation: dash-check 0.95s 0.35s ease-in-out forwards;
        animation: dash-check 0.95s 0.35s ease-in-out forwards;
    }

    @-webkit-keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @-webkit-keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @-webkit-keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }

        100% {
            stroke-dashoffset: 900;
        }
    }

    @keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }

        100% {
            stroke-dashoffset: 900;
        }
    }

    .box00 {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
</style>

<div class="container position-relative" id="cart">

    <div class="row">
        <div class="d-flex justify-content-center mb-4">
            <div class="me-5">
                <a href="" class=" text-decoration-none" style="font-size: 20px;"><i class="fa-solid fa-bag-shopping" style="font-size: 25px;"></i> Shopping Cart</a>
            </div>

            <div class="me-5">
                <i class="fa-solid fa-right-long"></i>
            </div>

            <div class="me-5">
                <a href="" class=" text-decoration-none" style="font-size: 20px;"><i class="fa-solid fa-folder-plus" style="font-size: 25px;"></i> Order</a>
            </div>

            <div class="me-5">
                <i class="fa-solid fa-right-long"></i>
            </div class="me-5">
            <div>
                <a href="" class=" text-decoration-none" style="font-size: 20px;"><i class="fa-solid fa-circle-check" style="font-size: 25px;"></i> Complete the order</a>

            </div>
        </div>
    </div>

    <div class="row mb-5" style="margin-top: 50px;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Img</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $id = 1;
                            $total = 0;
                            while ($cart = mysqli_fetch_assoc($queryGetInCart)) {

                                $subTotal = $cart['pr_price'] * $_SESSION['cart'][$cus_id][$cart['pr_id']]['quantity'];
                                $total += $subTotal;
                            ?>

                                <tr>
                                    <th scope="row"><?php echo $id  ?></th>
                                    <td>
                                        <img width="50px" height="70px" src="images/<?php echo $cart['pr_image']; ?>" alt="">
                                    </td>
                                    <td><?php echo $cart['pr_name']; ?></td>
                                    <td><?php echo '$' . number_format($cart['pr_price'], 0, '', '.'); ?></td>
                                    <td>
                                        <span type="text" name="tentacles" value="1" min="1" max="100">
                                            <?php echo $_SESSION['cart'][$cus_id][$cart['pr_id']]['quantity'] ?>
                                        </span>
                                    </td>
                                    <td><?php echo '$' . number_format($subTotal, 0, '', '.'); ?></td>
                                </tr>

                            <?php
                                $id += 1;
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-8">
            <div class="card">
                <form action="cart_process.php?action=store" method="post">


                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Delivery Address</h5>
                        </div>

                        <div class="col-12">
                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo $_SESSION['cust']['lastname'] . ' ' . $_SESSION['cust']['firstname'] ?>" class="form-control" id="inputName">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="text" name="email" value="<?php echo $_SESSION['cust']['email'] ?>" class="form-control" id="inputEmail">
                            </div>
                        </div>


                        <div class="col-12">
                            <label for="inputPhone" class="form-label">Phone</label>
                            <input type="text" name="phone" value="<?php echo $_SESSION['cust']['phone'] ?>" class="form-control" id="inputPhone" placeholder="01234567">
                        </div>

                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Address Detail</label>
                            <input type="text" name="address" value="<?php echo $_SESSION['cust']['address'] ?>" class="form-control" id="inputCity">
                        </div>


                        <div class="form col-md-12">
                            <label for="floatingTextarea" class="form-label">Note</label>
                            <textarea class="form-control" name="note" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="select" class="form-label"> <i class="fa-solid fa-money-check-dollar"></i> Pay Methods</label>

                            <select class="form-select" name="payment" aria-label="Default select example" id="select">
                                <option selected value="0">Mobile-banking</option>
                                <option value="1">Payment on delivery</option>

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="select1" class="form-label"><i class="fa-solid fa-truck"></i> Shipping Methods</label>

                            <select class="form-select" aria-label="Default select example" id="select1">
                                <option selected>Fast delivery</option>
                                <option value="1">Shipping Express</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="hidden" name="amount" value="<?php echo $total ?>" class="form-control">
                        </div>
                    </div>

                    <div class="float-end check-out__btn">
                        <button style="width: 300px;" type="submit" name="sm_checkout" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#statusSuccessModal"> <i class="fa-solid fa-check me-2"></i>Completed the order</button>

                    </div>

                </form>
            </div>
        </div>




        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">ORDER</h5>
                    <div class="d-flex justify-content-between" style="margin-top: 15px; margin-bottom: 10px;">
                        <b class="text-dark">Total price</b>
                        <b class="text-dark"> <?php echo '$' . number_format($total, 0, '', '.'); ?> </b>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Vouncher Code" aria-label="Vouncher Code" aria-describedby="button-addon2">
                        <button class="btn btn-danger" type="button" id="button-addon2"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <!-- <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                        <b class="text-dark">Sale</b>
                        <b class="text-dark">$2.000</b>
                    </div> -->
                    <div class="d-flex justify-content-between">
                        <b class="text-dark">Shipping Costs</b>
                        <b class="text-dark">Free</b>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <b class="text-danger">Total order</b>
                        <b class="text-danger"><?php echo '$' . number_format($total, 0, '', '.'); ?></b>
                    </div>
                    <hr>



                </div>

            </div>
        </div>

    </div>


    <!-- form product -->





    <!-- Massage Completed the order -->
    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                    </svg>
                    <h4 class="text-success mt-3">Completed the order!</h4>
                    <p class="mt-3">You have successfully the order.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Massage Completed the order -->
</div>
<!-- product cards -->




<a href="#" class="arrow"><i><img src="./images/arrow.png" alt=""></i></a>

<!-- script massage  city district -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        citis.onchange = function() {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
        };
        district.onchange = function() {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };
    }
</script>
<!-- script massage -->

<?php
include_once "default/footer.php";

?>