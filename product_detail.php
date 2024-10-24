<?php
session_start();
$title = "Product - Detail";
include_once "default/header.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM product WHERE pr_id = '$id'";
  $query = $connect->query($sql);

  if (mysqli_num_rows($query) > 0) {
    $product = ($query->fetch_assoc());
?>
    <!-- product cards -->



    <!-- <div class="container"> -->
    <div class="container">
      <div class="card detail" style="margin-top: 50px;">
        <!-- card product -->
        <div class="row">
          <div class="col-6">
            <div class="product-imgs">
              <div class="img-display">
                <div class="img-showcase">
                  <img id="regular" src="image/sofa.jpg" alt="sofa image" />
                  <img id="preview" src="image/sofa1.jpg" alt="sofa image" />
                </div>
              </div>

              <div class="img-select">
                <div class="img-item">
                  <a href="#" data-id="1">
                    <img src="image/sofa4.jpg" alt="sofa image" />
                  </a>
                </div>
                <div class="img-item">
                  <a href="#" data-id="2">
                    <img src="image/sofa1.jpg" alt="sofa image" />
                  </a>
                </div>
                <div class="img-item">
                  <a href="#" data-id="3">
                    <img src="image/sofa2.jpg" alt="sofa image" />
                  </a>
                </div>
                <div class="img-item">
                  <a href="#" data-id="4">
                    <img src="image/sofa3.jpg" alt="sofa image" />
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="product-content">
              <p style="color: darkgray; margin-top: -24px; font: size 15px;">Home/Category/ Sofa</p>
              <h5 class="product-title" style="font-size:30px;"><?php echo $product['pr_name'] ?></h5>
              <div class="product-rate">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <span>5(71)</span>
              </div>

              <div class="product-price">
                <p class="last-price text-primary">Old Price: <span>$257.00</span></p>
                <p class="new-price">New Price: <span><?php echo '$' . $product['pr_price'] ?></span></p>
              </div>

              <div class="product-detail">
                <h6>Overview this item:</h6>
                <p style="color: black;">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta
                  soluta recusandae nam! Dignissimos, cupiditate temporibus.
                </p>

              </div>

              <div class="category my-3">
                <span>Category:
                  <?php

                  $slqGetCategories = "SELECT category.name FROM category
                                  INNER JOIN product 
                                  ON category.id = product.category_id
                                  WHERE category.id = {$product['category_id']}";
                  // thực thi truy vấn
                  $queryGetCategories = $connect->query($slqGetCategories);

                  // var_dump($queryGetCategories);
                  $results = $queryGetCategories->fetch_assoc();
                  //   foreach ($result as $id=>$row) {

                  // while($result = ($queryGetCategories->fetch_all(MYSQLI_ASSOC))){



                  ?>
                  <?php echo $results['name'] ?>

                  <?php

                  // }?
                  ?>

                  <div class="available my-3">
                    <span>Available:
                      <?php if ($product['status'] == 1) {
                      ?>

                        Stocking

                      <?php  } else {
                      ?>
                        Out of Stocking
                      <?php
                      }
                      ?>
                    </span>
                  </div>

                  <div class="shipping my-3">
                    <span>Shipping Fee: <i class="fa-solid fa-truck-fast me-1"></i>Free </span>
                  </div>

                  <div class="color my-3">
                    <span>Color: </span>
                    <select style="width: 170px; display:inline; margin-left: 10px;" class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option selected>Choose color</option>
                      <option value="1">Lemonade</option>
                      <option value="2">Gray</option>
                      <option value="3">Gray+Lemonade</option>
                      <option value="4">Gray+Black</option>
                    </select>
                  </div>


                  <div class="purchase-info">
                    <a href="cart_process.php?action=add&id=<?php echo $product['pr_id']; ?>">
                      <button type="button" class="btn">
                        <i class="fa-solid fa-cart-plus me-2"></i>
                        Add to cart
                      </button>
                    </a>
                    <button type="button" class="btn">
                      <i class="fa-solid fa-wallet me-2"></i>
                      Buy Now
                    </button>
                  </div>

                  <div class="social-link">
                    <p>Share At:</p>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-skype"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                  </div>
              </div>
            </div>
          </div>
          <!-- card product -->
        </div>


        <!-- card product detail -->
        <div class="row my-3">
          <div class="col-12">
            <div class="card">
              <div class="prd_detail">
                <div>
                  <span>
                    <h4 class="mx-3 mt-3" style="background-color:beige; padding:10px;">PRODUCT DETAILS</h4>
                  </span>
                </div>
                <div class="details mt-3" style="margin-left: 36px;">
                  <span style="margin-right: 86px;">Category: </span> <a style="text-decoration: none;" href="index.php"> shop</a>
                  <i class="fa-solid fa-angle-right"></i><a style="text-decoration: none; margin-left:5px;" href="product.php">Category</a>
                  <i class="fa-solid fa-angle-right"></i><a style="text-decoration: none; margin-left:5px;" href="category_product.php">Sofa</a>
                  <i class="fa-solid fa-angle-right"></i><a style="text-decoration: none; margin-left:5px;" href="product_detail.php">Sofa Double ZHENZHEN</a>
                  <br>
                  <span style="margin-right: 27px;">Warranty period: </span> 3 months
                  <br>
                  <span style="margin-right: 27px;">Number product: </span> 45
                  <br>
                  <span style="margin-right: 78px;">Sent from: </span> Bac Giang
                </div>
              </div>

              <div class="prd_detail">
                <span>
                  <h4 class="mx-3" style="background-color:beige; padding: 10px;">PRODUCT DESCRIPTION</h4>
                </span>

                <div class="details mt-3" style="margin-left: 36px;">
                  <span>
                    Double lazy sofa:
                  </span>
                  <br>
                  <span>Measured size: 105*65*60cm;</span>
                  <br>
                  <span>Sofa cover material: Snowflake;</span>
                  <br>
                  <span>Inner filling: EPS eco-friendly foam granules</span>
                  <br>

                  <img src="image/des1.jpg" alt="">
                  <img src="image/des2.jpg" alt="">
                  <img src="image/des3.jpg" alt="">
                </div>
              </div>

            </div>


          </div>
        </div>
      </div>
      <!-- card product detail -->
    </div>
    <!-- </div> -->


    <a href="#" class="arrow"><i><img src="./images/arrow.png" alt="" /></i></a>

    <script>
      const allHoverImages = document.querySelectorAll(`.img-select .img-item a img`)
      const imgContainer = document.querySelector(`.img-showcase`);
      const imgSelect = document.querySelector(".img-select");


      imgSelect.addEventListener("mouseleave", () => {
        resetActiveImg();
        imgContainer.querySelector("img").classList.remove(`d-none`);
      });

      window.addEventListener(`DOMContentLoaded`, () => {
        allHoverImages[0].parentElement.classList.add(`active`);
      });

      allHoverImages.forEach((image) => {
        image.addEventListener(`mouseover`, () => {
          // console.log(image.src);
          document.querySelector("#preview").src = image.src;
          document.querySelector("#regular").classList.add("d-none");

          resetActiveImg();
          image.parentElement.classList.add(`active`);
        });
      });

      function resetActiveImg() {
        allHoverImages.forEach((img) => {
          img.parentElement.classList.remove(`active`);
        });
      }
    </script>

    <?php
    include_once "default/footer.php";
    ?><!-- product cards -->
<?php
  }
} else {
  header('Location: index.php');
}
?>