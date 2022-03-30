<?php
include 'action/function.php';
$tweets = runSql("SELECT * from tweets");
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
            <a href="login_page.php" class="text-decoration-none text-black me-1">Log In </a>
            <span> / </span>
            <a href="register_page.php" class="text-decoration-none text-black ms-1">Register </a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><input type="text" class="form-control" placeholder="Search" id="search" onchange="search()" style="width: 800px; margin-left:40px"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login_page.php">Your Tweet</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-left: 650px">
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
                            <a href="login_page.php" class="btn btn-primary me-3">Comment</a>
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
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>