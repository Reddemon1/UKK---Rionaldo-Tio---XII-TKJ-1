<?php
include 'action/secure.php';
include 'action/function.php';
$user = $_SESSION['user'];
$userId = $user['id'];
$tweets = runSql("SELECT * from tweets where user_id='$userId'");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h5 onclick="location.href='index_user.php'">Welcome, <span class="text-primary"><?php echo $user['name'] ?></span> </h5>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"><input type="text" class="form-control" placeholder="Search" id="search" onchange="search()" style="width: 800px; margin-left:40px"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tweet_page.php">Your Tweet</a>
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
            <h3 class="mt-3">Your Tweet</h3>
            <button class="btn btn-primary mt-2 ms-3" style="height: 50px;" onclick="location.href = 'new_tweet.php'">Make New Tweet</button>
        </div>
        <?php
        foreach ($tweets as $tweet) :
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
                            <a href="comment.php?id=<?php echo $tweet['id'] ?>" class="btn btn-primary me-3">Comment</a>
                            <a href="edit_tweet.php?id='<?php echo $tweet['id'] ?>'" class="btn btn-warning me-3">Edit</a>
                            <form action="action/tweet.php" method="POST">
                                <input type="hidden" name="id" id="id" value="<?php echo $tweet['id'] ?>">
                                <button type="submit" class="btn btn-danger" name="method" value="Delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        <?php
        endforeach
        ?>
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