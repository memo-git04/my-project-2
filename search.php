<?php
$title = "Search";
session_start();
include_once "default/header.php";
$search = $_GET['search'];

$search = strtolower($search);

$query = $connect->query("SELECT * FROM product WHERE lower(pr_name) like '%$search%'");

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

// var_dump($result);
?>




<!-- product cards -->
<div class="container" id="product-cards">
    <h5 class="text">Result search: <?php echo $_GET['search'] ?></h5>
    <hr>
    <div class="row" style="margin-top: 30px">
        <?php
        foreach ($result as $product) {
        ?>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <a href="product_detail.php"><img src="./image/card3.png" alt="" /></a>
                    <div class="card-body">
                        <h3 class="text"><?php echo $product['pr_name'] ?></h3>
                        <p class="text"><?php echo $product['description'] ?></p>
                        <div class="star text">
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                        </div>
                        <h2>
                            <?php echo $product['pr_price'] ?><span>
                                <li class="fa-solid fa-cart-shopping"></li>
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<!-- newslater -->
<div class="container" id="newslater">
    <h3 class="text-center">
        Subscribe To The Electronic Shop For Latest upload.
    </h3>
    <div class="input text-center">
        <input type="text" placeholder="Enter Your Email.." />
        <button id="subscribe">SUBSCRIBE</button>
    </div>
</div>
<!-- newslater -->

<!-- footer -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Furniture Shop</h3>
                    <p>
                        Famous and diverse furniture brand. Brings happiness to every
                        family!
                    </p>
                    <br />
                    <p>
                        <i id="iconsi" class="fa-solid fa-location-dot"></i> La Khê, Hà
                        Đông, Hà Nội.
                    </p>
                    <br />
                    <p>
                        <i id="iconsi" class="fa-solid fa-phone-volume"></i> +84 98 -
                        3683 - 244
                    </p>
                    <br />
                    <p>
                        <i id="iconsi" class="fa-solid fa-envelope"></i>
                        furnitureshop@gmail.com
                    </p>
                    <br />
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Usefull Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policey</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>

                    <ul>
                        <li><a href="#">Sofa</a></li>
                        <li><a href="#">Desk</a></li>
                        <li><a href="#">Trouser</a></li>
                        <li><a href="#">Bed</a></li>
                        <li><a href="#">Table</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia,
                        quibusdam.
                    </p>

                    <div class="socail-links mt-3">
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-skype"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>Electronic Shop</span></strong>. All Rights Reserved
        </div>
        <div class="credits">Designed by <a href="#">SA coding</a></div>
    </div>
</footer>
<!-- footer -->

<a href="#" class="arrow"><i><img src="./images/arrow.png" alt="" /></i></a>



<?php
include_once "default/footer.php";
?><!-- product cards -->