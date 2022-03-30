<?php
session_start();

if (!$_SESSION['auth']) { //jika auth berisi false maka akan melemparkan user ke dalam login page
    header("location:login_page.php");
}
