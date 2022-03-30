<?php
include "function.php";
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
} else {
    $email = $_GET['email'];
    $password = $_GET['password'];
}

$sql = runSql("SELECT * from users WHERE email='$email' AND password='$password'");

$check = mysqli_num_rows($sql);
session_start();
//Melakukan pengecekan apakah user dengan email dan password yang telah dimasukkan terdaftar dalam database
if ($check != null) {
    $res = mysqli_fetch_array($sql);
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $res;
    header("location:../index_user.php");
} else {
    $_SESSION['auth'] = false;
    header("location:../login_page.php");
}
