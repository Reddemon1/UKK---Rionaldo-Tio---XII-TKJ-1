<?php
include 'function.php';
$method = $_POST['method'];
$bio = $_POST['bio'];
$userId = $_POST['user_id'];
if ($method == "Update") { //Melakukan pengeditan pada data tweet
    $id = $_POST['id'];
    if ($_FILES['image']['size'] != 0) { // melakukan pengecekan apakah tweet menggunakan image dan mengupload image ke folder image 
        $imageLoc = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($imageLoc, "../Image/" . $imageName);
        $updateNoImage = runSql("UPDATE users SET image='Image/$imageName',bio='$bio' where id=$id");
    } else { // mengubah data tweet tanpa image
        $updateWithImage = runSql("UPDATE users SET bio='$bio',hash_tag='$tags' where id=$id");
    }
}


header("location:../profile.php");
