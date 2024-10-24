<?php
ob_start();
include_once "admin/config/db.php";
session_start();
$title = "Home";
include_once "default/header.php";


$sqlGetProducts = "SELECT * FROM  product ";

$queryGetProducts = $connect->query($sqlGetProducts);

$result = mysqli_fetch_all($queryGetProducts, MYSQLI_ASSOC);

// var_dump($queryGetProducts->fetch_all());

?>
<!-- home content -->
<section class="home">
  <div class="content">
    <h1>
      <span>Furniture Products</span>
      <br />
      Up To <span id="span2">50%</span> Off
    </h1>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta, saepe.
      <br />Lorem ipsum dolor sit amet consectetur.
    </p>
    <div class="btn"><button>Shop Now</button></div>
  </div>
</section>
<!-- home content -->

<!-- product cards -->


<?php
require_once "default/popular_prd.php";
?>
<!-- product cards -->

<!-- our gallary start -->
<div class="container" id="gallary">
  <h1 class="text-center">Our Gallary</h1>
  <div class="row gallary-img">
    <div class="col-sm-5 col-md-6">
      <div class="card">
        <img src="images/g1.png" alt="" />
      </div>
    </div>

    <div class="col-sm-5 col-md-6 offset-md-0">
      <div class="card">
        <img src="images/g2.png" alt="" />
      </div>
      <div class="card">
        <img src="images/g3.png" alt="" />
      </div>
    </div>
  </div>
</div>
<!-- our gallary end -->

<!-- 50% off products -->
<?php
require_once "default/off_product.php";
?>
<!-- product cards end -->

<!-- banner -->
<div class="banner">
  <div class="banner-content">
    <h5>Get Discount Up To 50%</h5>
    <h3>Best Deal For week</h3>
    <p>Get up to 50% off this weak and get offer <br />Don't miss</p>
    <button><a href="product_detail.html">Order</a></button>
  </div>
</div>
<!-- banner -->

<!-- offer start-->
<div class="container" id="offer">
  <div class="row">
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-headset"></i>
      <h3>Support 24/7</h3>
    </div>
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-rotate"></i>
      <h3>Free Exchange</h3>
    </div>
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-truck-fast"></i>
      <h3>Free shipping</h3>
    </div>
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-gifts"></i>
      <h3>Black Friday</h3>
    </div>
  </div>
</div>
<!-- offer end -->

<!-- about us start-- -->

<!-- about us end-- -->
<?php
include_once "default/footer.php";
?>