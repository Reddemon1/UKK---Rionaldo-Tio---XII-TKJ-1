<?php
include "function.php";
$eventId = $_POST['event_id'];
$method = $_POST['method'];

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $comment = $_POST['comment'];
}

if ($method == "Save") { //Mnembahkan comment
    $tags = tags($comment);
    $insertComment = runSql("INSERT into comments (comment,hash_tag,event_id,user_id) values ('$comment','$tags',$eventId,$userId)");
    if ($tags != null) {
        commentRelation($tags, $comment, $userId);
    }
} else if ($method == "Delete") { //Menghapus data comment
    $id = $_POST['id'];
    $deleteComment = runSql("DELETE from comments where id=$id");
    $deleteRelation = runSql("DELETE from tag_comment where comment_id=$id");
} else if ($method == "Update") { //Melakukan pengeditan pada comment
    $id = $_POST['id'];
    $tags = tags($comment);
    $updateComment = runSql("UPDATE comments SET comment='$comment',hash_tag='$tags' where id=$id");
    $deleteRelation = runSql("DELETE from tag_comment where comment_id=$id");
    if ($tags != null) {
        commentRelation($tags, $comment, $userId);
    }
}
header("location:../comment.php?id=$eventId");
