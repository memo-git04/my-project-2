<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'database';
$connect = null;

function doConnection()
{
    global $hostname;
    global $username;
    global $password;
    global $database;
    global $connect;
    $connect = mysqli_connect($hostname, $username, $password, $database);

    if (!$connect) {
        die("Connection fail." . mysqli_connect_error()); //loi ket noi 
    }

    // kết nối thành công => thiết lập mã hóa (Hiển thị tiếng Việt)
    setCharset('utf8');
    return $connect;
}

function closeConnection()
{
    global $connect;
    if ($connect != null) {
        mysqli_close($connect);
    }
}

function setCharset($charset)
{
    global $connect;
    mysqli_set_charset($connect, $charset);
}