<?php
ob_start();
session_start();
$cate_name = $_GET['category'];
$title = "$cate_name";
include_once "default/header.php";

// $sqlGetCategory = "SELECT * FROM product 
//                       INNER JOIN category ON product.category_id = category.id WHERE category.name = '$cate_name'";
// $queryGetCategory = $connect->query($sqlGetCategory); 
//goi theo phuong thuc


$total = mysqli_num_rows($queryGetCategory);


// echo $total;

$limit = 4;

$page = ceil($total / $limit);

$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
// echo $cr_page;

$start = ($cr_page - 1) * $limit;

$row = mysqli_query($connect, "SELECT * FROM product 
                      INNER JOIN category ON product.category_id = category.id WHERE category.name = '$cate_name' LIMIT $start, $limit");

?>
<!-- product cards -->


<!-- product cards -->
<div class="container" id="product-cards">
  <h1 class="text-center"><?php echo $cate_name ?></h1>
  <div class="row" style="margin-top: 30px">
    <?php
    // while ($result = $queryGetCategory->fetch_assoc()) {
    foreach ($row as $result) {
    ?>

      <div class="col-md-3 py-3 py-md-0 mb-3">
        <div class="card">
          <img src="images/<?php echo $result['pr_image'] ?>" alt="" />
          <div class="card-body">
            <h3 class="text"><?php echo $result['pr_name'] ?></h3>
            <p class="text"><?php echo $result['description'] ?></p>
            <div class="star text">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
            </div>
            <h2>
              <?php echo $result['pr_price'] ?><span>
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


<!-- offer end -->

<!-- phan trang -->
<nav aria-label="Page navigation example" style="text-align: center; display:ruby-text;">
  <ul class=" pagination">
    <?php
    if ($cr_page - 1 > 0) {
    ?>
      <li class="page-item">
        <a class="page-link" href="category_product.php?category=<?php echo $cate_name ?>&page=<?php echo $cr_page - 1 ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php
    }
    ?>

    <?php
    for ($i = 1; $i <= $page; $i++) {
    ?>

      <li class="page-item <?php echo (($cr_page == $i) ? 'active' : " ") ?>"><a class="page-link" href="category_product.php?category=<?php echo $cate_name ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php
    }
    ?>

    <?php
    if ($cr_page + 1 <= $page) {
    ?>
      <li class="page-item">
        <a class="page-link" href="category_product.php?category=<?php echo $cate_name ?>&page=<?php echo $cr_page + 1 ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>

    <?php
    }
    ?>
  </ul>
</nav>


<?php
include_once "default/footer.php";
?><!-- product cards -->