<?php
ob_start();
session_start();
$title = "Home";
include_once "admin/config/db.php";
include_once "default/header.php";


$sqlGetProducts = "SELECT * FROM  product ";

$queryGetProducts = $connect->query($sqlGetProducts);

$result = mysqli_fetch_all($queryGetProducts, MYSQLI_ASSOC);
?>

<?php
require_once "default/off_product.php";
?>


<?php
require_once "default/popular_prd.php";
?>


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