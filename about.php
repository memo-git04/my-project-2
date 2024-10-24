<?php
$title = "About";
session_start();
include_once "default/header.php";

?>

<div class="container" id="about">
  <h3>About Us</h3>
  <hr />
  <p>
    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam odit
    quae modi cumque, dolorum id rat repudiandae tenetur facere
    veritatis inventore nam sequi. Id ipsam, odio rerum doloremque quam
    natus perferendis saepe est sapiente optio, ab dolore quaerat temporibus
    quia non, neque mollitia earum? Ab soluta magnam officiis quasi
    deleniti, tempora in ex vitae praesentium quaerat facere saepe
    laudantium temporibus nesciunt recusandae voluptas totam, iste nihil
    amet et. Fugiat istenn eaque provident at omnis. Non asperiores rem fuga
    id vel ipsum libero corporis? Voluptatem, ullam omnis. Assumenda ipsa
    sunt sit quidem eligendi reiciendis, deleniti voluptatibus, molestias
    vel, ab ea quam?
  </p>
  <hr />
  <div class="row" style="margin-top: 50px">
    <div class="col-md-5 py-3 py-md-0">
      <div class="card">
        <img style="height: 250px" src="./image/background.png" alt="" />
      </div>
    </div>
    <div class="col-md-7 py-3 py-md-0">
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima
        fugit ad impedit libero quis. Ipsamm accusantium non minima
        excepturi nemo doloremque, inventore dolores at aperiam voluptates
        voluptatem maiores odit. Unde dolorum similique facilis veritatis
        exercitationem excepturi sunt, non at quis deleniti! Mollitia
        quaerat temporibus reprehenderit neque esse unde minima sed illo,
        perferendis quidem eum voluptatem ipsam aliquam modi doloremque
        error. Odit amet veniam necessitatibus quis ad voluptate quidem
        laudantium, quia vitae quisquam dolorem deleniti temporibus
        reiciendis, rerum delectus quo cupiditate velit consequuntur neque
        eum est vero? Perspiciatis architecto provident illo sequi
        reprehenderit quasi excepturi hic sint perferendis, tempore
        cupiditate.
      </p>
      <button>Read More...</button>
    </div>
  </div>
</div>

<!-- offer -->
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
<!-- offer -->



<a href="#" class="arrow"><i><img src="./images/arrow.png" alt="" /></i></a>

<?php
include_once "default/footer.php";
?>