<?php
include "action/secure.php";
include 'action/function.php';
$user = $_SESSION['user'];
$id = $_GET['id'];
$detail = runSql("SELECT * FROM tweets where id=$id");
$comments = runSql("SELECT * FROM comments where event_id=$id");
$tweet = mysqli_fetch_array($detail);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Comment</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h5 onclick="location.href='index_user.php'">Welcome, <span class="text-primary"><?php echo $user['name'] ?></span> </h5>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><input type="text" class="form-control" placeholder="Search" id="search" onchange="search()" style="width: 800px; margin-left:40px"></a>
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
        <div class="d-flex">
            <img src="<?php echo $tweet['image'] ?>" width="50%" alt="">
            <div class="border" style="width: 100%;">
                <p class="mt-5 ms-5 mb-5"><?php echo $tweet['text'] ?></p>
                <hr>
                <h3 class="mt-5 ms-5">Comments</h3>
                <div class="mt-4">
                    <?php
                    foreach ($comments as $comment) :
                    ?>
                        <div class="comment border pb-2 pt-2 ps-2 pe-2 mt-2 ms-5 d-flex " style="width: 85%;">

                            <p class="" style="width: 100%;"><?php echo $comment['comment'] ?></p>
                            <?php
                            if ($comment['user_id'] == $user['id']) {
                                $idComment = $comment['id'];
                                // echo $idComment;
                                $text = $comment['comment'];
                            ?>
                                <button class="btn btn-warning" onclick="editComment(<?php echo "'$idComment','$text'" ?>)">Edit</button>
                                <form action="action/comment_input.php" method="POST">
                                    <input type="hidden" name="event_id" value="<?php echo $id ?>">
                                    <input type="hidden" name="id" value="<?php echo $idComment ?>">
                                    <button class="btn btn-danger ms-1" name="method" value="Delete">Delete</button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    endforeach
                    ?>
                </div>
                <div class="mt-5 ms-5">
                    <form action="action/comment_input.php" method="POST" class="d-flex">
                        <input type="hidden" name="event_id" value="<?php echo $id ?>">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                        <input type="text" class="form-control" placeholder="Comment" name="comment" id="comment" style="width: 80%;">
                        <button class="btn btn-success" name="method" id="method" value="Save" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function editComment(id, text) {
            document.getElementById('comment').value = text;
            document.getElementById('id').value = id;
            document.getElementById('method').value = "Update";
        }

        function search() {
            var input = document.getElementById('search').value;
            location.href = "search.php?search=" + input;
        }
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>