<?php
$id = $_GET["pr_id"];
$sqlDeleteQuery = "UPDATE product set isdeleted=1 where pr_id = '$id'";
$connect->query($sqlDeleteQuery);
header("Location:/web/admin/index.php?page_layout=product.php");
?>