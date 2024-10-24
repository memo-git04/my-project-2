<?php
session_start();
if (isset($_SESSION['cust'])) {
    unset($_SESSION['cust']);

    header("Location:/web");
}
