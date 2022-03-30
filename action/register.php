<?php
include "function.php";
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = runSql("INSERT into users (name,email,password) VALUES ('$name','$email','$password')"); //menambahkan user baru ke dalam database

header("location:login.php?email=$email&password=$password");
