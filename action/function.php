<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "ukk";

$conn = mysqli_connect($host, $user, $password, $db);

//Menjalankan sql yang di masukkan ke dalam parameter pada function 
function runSql($sql)
{
    global $conn;
    $query = mysqli_query($conn, $sql) or die($sql);
    return $query;
}
//Memisahkan antara text pada tweet dengan hashtag
function tags($text)
{
    $tags = explode('#', $text);
    array_splice($tags, 0, 1);
    $tagCol = "";
    foreach ($tags as $tag) {
        $sqlTag = runSql("SELECT * FROM tags where tag='$tag'");
        $checkTag = mysqli_num_rows($sqlTag);
        if ($checkTag == 0) {
            $addTag = runSql("INSERT into tags(tag) VALUES ('$tag')");

            $getTag = runSql("SELECT * FROM tags where tag='$tag'");
            $dataTag = mysqli_fetch_array($getTag);
            $tagId = $dataTag['id'];
            $tagCol = $tagCol . $dataTag['id'] . ",";
        } else {
            $getTag = runSql("SELECT * FROM tags where tag='$tag'");
            $data = mysqli_fetch_array($getTag);
            $tagCol = $tagCol . $data['id'] . ",";
        }
    }
    $tweetTag = substr_replace($tagCol, "", -1);
    return $tweetTag;
}
function commentRelation($tags, $comment, $userId)
{
    $arrTag = explode(",", $tags);
    if ($arrTag != null) {
        foreach ($arrTag as $tag) {
            $getComment = runSql("SELECT * FROM comments where comment='$comment' && user_id=$userId && hash_tag='$tags'");
            $dataComment = mysqli_fetch_array($getComment);
            $commentId = $dataComment['id'];
            $tagId = $tag;
            $sqlTagComment = runSql("INSERT INTO tag_comment (tag_id,comment_id) values($tagId,$commentId)");
        }
    }
}
function tweetRelation($tags, $text, $userId)
{
    $arrTag = explode(",", $tags);
    if ($arrTag != null) {
        foreach ($arrTag as $tag) {
            $getTweet = runSql("SELECT * FROM tweets where text='$text' && user_id=$userId && hash_tag='$tags'");
            $dataTweet = mysqli_fetch_array($getTweet);
            $tweetId = $dataTweet['id'];
            $tagId = $tag;
            $sqlTagComment = runSql("INSERT INTO tag_tweet (tag_id,tweet_id) values($tagId,$tweetId)");
        }
    }
}
