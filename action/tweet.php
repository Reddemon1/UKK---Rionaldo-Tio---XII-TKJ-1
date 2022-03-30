<?php
include 'function.php';
$method = $_POST['method'];
if (isset($_POST['text'])) {
    $text = $_POST['text'];
    $userId = $_POST['user_id'];
}
if ($method == "Save") {
    $tags = tags($text);
    if ($_FILES['image']['size'] != 0) { // melakukan pengecekan apakah tweet menggunakan image dan mengupload image ke folder image 
        $imageLoc = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($imageLoc, "../Image/" . $imageName);
        $insertNoImage = runSql("INSERT into tweets (image,text,hash_tag,user_id) values ('Image/$imageName','$text','$tags',$userId)");
    } else { // memasukkan data tweet tanpa image
        $insertWithImage = runSql("INSERT into tweets (text,hash_tag,user_id) values ('$text','$tags',$userId)");
    }
    if ($tags != null) {
        tweetRelation($tags, $text, $userId);
    }
} else if ($method == "Delete") { //Menghapus  data tweet
    $id = $_POST['id'];
    $deleteTweet = runSql("DELETE from tweets where id='$id'");
    $deleteRelation = runSql("DELETE from tag_tweet where tweet_id=$id");
} else if ($method == "Update") { //Melakukan pengeditan pada data tweet
    $id = $_POST['id'];
    $tags = tags($text);
    if ($_FILES['image']['size'] != 0) { // melakukan pengecekan apakah tweet menggunakan image dan mengupload image ke folder image 
        $imageLoc = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($imageLoc, "../Image/" . $imageName);
        $updateNoImage = runSql("UPDATE tweets SET image='Image/$imageName',text='$text',hash_tag='$tags' where id=$id");
    } else { // mengubah data tweet tanpa image
        $updateWithImage = runSql("UPDATE tweets SET text='$text',hash_tag='$tags' where id=$id");
    }
    $deleteRelation = runSql("DELETE from tag_tweet where tweet_id=$id");

    if ($tags != null) {
        tweetRelation($tags, $text, $userId);
    }
}


header("location:../tweet_page.php");
