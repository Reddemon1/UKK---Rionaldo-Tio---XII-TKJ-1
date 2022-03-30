<?php
include "action/function.php";
include "action/secure.php";
// include 'action/function.php';
$user = $_SESSION['user'];

$search = $_GET['search'];

$getTag = runSql("SELECT * from tags where tag='$search'");
$countTag = mysqli_num_rows($getTag);

if ($countTag != 0) {
    $res = mysqli_fetch_array($getTag);
    $tagId = $res['id'];
    // echo $tagId;
    $getTweet = runSql("SELECT * FROM tag_tweet LEFT JOIN tweets on tag_tweet.tweet_id = tweets.id where tag_id=$tagId");
    $getComment = runSql("SELECT * FROM tag_comment LEFT JOIN comments on tag_comment.comment_id = comments.id where tag_id=$tagId");
    // var_dump($getTweet);
} else {
    $getTweet = [];
    $getComment = [];
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Search</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h5 onclick="location.href='index_user.php'">Welcome, <span class="text-primary"><?php echo $user['name'] ?></span> </h5>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><input type="text" class="form-control" placeholder="Search" id="search" style="width: 800px; margin-left:40px" onchange="search()"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tweet_page.php">Your Tweet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="action/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Tweets</h1>
        <?php
        foreach ($getTweet as $tweet) :
        ?>
            <div class="row mb-3">

                <div class="card" style="width: 35rem;">
                    <?php
                    if ($tweet['image'] != null) {
                    ?>
                        <img src="<?php echo $tweet['image'] ?>" alt="...">
                    <?php
                    }
                    ?>
                    <div class="card-body">
                        <p class="card-text"><?php echo $tweet['text'] ?></p>
                        <div class="d-flex">
                            <a class="btn btn-primary me-3" href="comment.php?id=<?php echo $tweet['id'] ?>">Comment</a>
                        </div>
                    </div>
                </div>

            </div>
        <?php
        endforeach
        ?>
        <h1>Comments</h1>
        <div class="mt-4">
            <?php
            foreach ($getComment as $comment) :
            ?>
                <div class="comment border pb-2 pt-2 ps-2 pe-2 mt-2  d-flex " style="width: 85%;">

                    <p class="" style="width: 100%;"><?php echo $comment['comment'] ?></p>
                </div>
            <?php
            endforeach
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function search() {
            var input = document.getElementById('search').value;
            location.href = "search.php?search=" + input;
        }
    </script>
</body>

</html>