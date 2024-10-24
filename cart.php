<?php
ob_start();
session_start();
$title = "Cart";

if (!isset($_SESSION['cust'])) {
  header('location: http://localhost/web/login.php');
  // echo "ok";
}
$cusid = $_SESSION['cust']['cus_id'];
if (empty($_SESSION['cart'][$cusid])) {
  $_SESSION['cart'] = [];
}
include_once "default/header.php";



// echo "<pre>";
// print_r($_SESSION['cart']);


// cart them form
$pr_id_list = "";
$cus_id = $_SESSION['cust']['cus_id'];
foreach ($_SESSION['cart'][$cus_id] ?? [] as $key => $value) {
  $pr_id_list .= $key . ",";
}


if (empty($_SESSION['cart'])) {
  echo "<div style='text-align:center; margin-top: 30px;'><h3>Cart empty</h3></div>";
} else {
  // echo $pr_id_list;

  $pr_id_list = rtrim($pr_id_list, ","); // cat dau , trong chuoi
  $pr_id_list = '(' . $pr_id_list . ')';

  // echo $pr_id_list;

  $sqlGetInCart = "SELECT * FROM product WHERE pr_id IN $pr_id_list";
  $queryGetInCart = mysqli_query($connect, $sqlGetInCart);

  // var_dump($queryGetInCart->fetch_all());

?>


  <!-- product cards -->
  <div class="container" id="cart">
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

    <div class="row">

      <div class="col-8">
        <div class="card">


          <form method="post" action="cart_process.php?action=update">
            <div class="card-body">
              <table class="table  table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">
                      No.
                    </th>
                    <th scope="col">Img</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Act</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                  while ($cart = mysqli_fetch_assoc($queryGetInCart)) {
                    $subTotal = $cart['pr_price'] * $_SESSION['cart'][$cus_id][$cart['pr_id']]['quantity'];
                    $total += $subTotal;
                    // var_dump($_SESSION['cart'][$cart['pr_id']]);

                  ?>
                    <tr>

                      <td>
                        <?php echo $cart['pr_id']; ?>
                      </td>
                      <td>
                        <img width="70px" height="100px" src="images/<?php echo $cart['pr_image']; ?>" alt="">
                      </td>
                      <td><?php echo $cart['pr_name']; ?></td>
                      <td><?php echo '$' . number_format($cart['pr_price'], 0, '', '.'); ?></td>
                      <td>
                        <input class="quantity_input" type="number" id="quantity" name="quantity[<?php echo $cart['pr_id'] ?>]" value="<?php echo $_SESSION['cart'][$cus_id][$cart['pr_id']]['quantity'] ?>" min=1 />
                      </td>
                      <td class="price"><?php echo '$' . number_format($subTotal, 0, '', '.'); ?></td>
                      <td>
                        <a href="cart_process.php?action=delete&id=<?php echo $cart['pr_id'] ?>">
                          <button type="submit" name="submit_delete" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>

                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>

              </table>
              <div>


                <button style="width: 300px;" type="submit" name="delete_all" class="btn btn-outline-danger text-center">Delete All</button>

                <button style="width: 300px;" type="submit" name="submit_update" class="btn btn-outline-danger text-center">Update Cart</button>

              </div>
            </div>
          </form>


        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">ORDER</h5>
            <p class="card-text">Please enter the discount code in the next step !.</p>

            <hr>
            <div class="d-flex justify-content-between">
              <b class="text-danger">Total</b>
              <b class="total_price text-danger"><?php echo '$' . number_format($total, 0, '', '.'); ?></b>
            </div>
            <hr>
            <div>
              <a href="checkout.php">
                <button style="width: 300px;" type="submit" class="btn btn-danger text-center">Check out</button>

              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


<?php

}

?>
<!-- product cards -->


<script src="js/add_cart.js" async></script>


<a href="#" class="arrow"><i><img src="./images/arrow.png" alt=""></i></a>

<?php
include_once "default/footer.php";
?>