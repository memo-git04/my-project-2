<?php
// print_r($result);
$total = count($result);

// echo $total;

$limit = 8;

$page = ceil($total / $limit);

$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
// echo $cr_page;

$start = ($cr_page - 1) * $limit;

$result = mysqli_query($connect, "SELECT * FROM product LIMIT $start, $limit");



?>



<div class="container" id="product-cards">
    <h1 class="text-center">Popular Products</h1>
    <div class="row" style="margin-top: 30px; margin-bottom: 30px;">

        <?php
        foreach ($result as $row) {
        ?>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card mb-5">
                    <a href="product_detail.php?id=<?php echo $row['pr_id'] ?>"><img src="images/<?php echo $row['pr_image'] ?>" alt="" /></a>
                    <div class="card-body">
                        <h3 class="text"><?php echo $row['pr_name'] ?></h3>
                        <p class="text">Lorem ipsum dolor sit amet.</p>
                        <div class="star text">
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                            <i class="fa-solid fa-star checked"></i>
                        </div>
                        <h2>
                            <?php echo '$' . $row['pr_price'] ?>
                            <span><a href="cart_process.php?action=add&id=<?php echo $row['pr_id']; ?>">
                                    <li class="fa-solid fa-cart-shopping"></li>
                                </a></span>
                        </h2>
                        <!-- <div class="con">
            <a href=""><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a>
            <a href=""><button type="button" class="btn btn-primary">Buy Now</button></a>
          </div> -->
                    </div>
                </div>
            </div>

        <?php
        }
        ?>

        <nav aria-label="Page navigation example" style="text-align: center; display:ruby;">
            <ul class="pagination">
                <?php
                if ($cr_page - 1 > 0) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $cr_page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php
                }
                ?>

                <?php
                for ($i = 1; $i <= $page; $i++) {
                ?>

                    <li class="page-item <?php echo (($cr_page == $i) ? 'active' : " ") ?>"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                }
                ?>

                <?php
                if ($cr_page + 1 <= $page) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $cr_page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>

                <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</div>