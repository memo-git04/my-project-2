<!-- 50% off products -->
<div class="container" id="product-cards">
    <h1 class="text-center">50% Off Products</h1>
    <div class="row" style="margin-top: 30px">

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


    </div>
</div>
<!--50%  product cards end -->