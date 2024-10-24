<?php
$title = "Profile";
ob_start();
session_start();
include_once "default/header.php";

$cusId = $_SESSION['cust']['cus_id'];


if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $sql = "UPDATE customers SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address' WHERE cus_id = $cusId";
    $queryInsertCus = $connect->query($sql);

    $sqlGetProducts = "SELECT * FROM  customers WHERE  cus_id = $cusId";

    $queryGetProducts = $connect->query($sqlGetProducts);

    $result = mysqli_fetch_assoc($queryGetProducts);

    $_SESSION['cust'] = $result;

    header('location:http://localhost/web/profile.php');
}



$sqlGetProducts = "SELECT * FROM  customers WHERE  cus_id = $cusId";

$queryGetProducts = $connect->query($sqlGetProducts);

$result = mysqli_fetch_assoc($queryGetProducts);



?><!-- product cards -->
<div class="container" id="cart">
    <div class="row my-3">
        <div class="text">
            <h3>Profile</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="card" style="width: 16rem;">
                <img src="./images/p3.png" class="card-img-top" alt="...">
                <button type="button" class="btn btn-outline-secondary btn-sm" style="width: 9rem; margin-left: 3rem; margin-bottom: 1rem; margin-top:-3rem;">Choose Img</button>
            </div>
        </div>
        <div class="col-sm-9">
            <form class="row g-3" method="POST" action="">
                <div class="col-md-6">
                    <label for="inputName" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" id="inputName" value="<?php echo $result['firstname'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputName" class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" id="inputName" value="<?php echo $result['lastname'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="inputEmail" value="<?php echo $result['email'] ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="01234567" value="<?php echo $result['phone'] ?>">
                </div>
                <div class="col-md-12">
                    <label for="inputCity" class="form-label">Address Detail</label>
                    <input type="text" class="form-control" name="address" id="inputCity" value="<?php echo $result['address'] ?>">
                </div>
                <button type="submit" name="submit" style="width: 51rem;" class="btn btn-danger">Save changes</button>
            </form>
        </div>
    </div>
</div>
<!-- product cards -->


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



<a href="#" class="arrow"><i><img src="./images/arrow.png" alt=""></i></a>

<?php
include_once "default/footer.php";
?>