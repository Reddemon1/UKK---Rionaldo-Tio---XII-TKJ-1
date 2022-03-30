<?php
include "action/secure.php";
include 'action/function.php';
$logged = $_SESSION['user'];
$id = $logged['id'];
$sql = runSql("SELECT * from users where id=$id");
$user = mysqli_fetch_array($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Profile</title>
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
        <h1>Profile</h1>
        <?php
        if ($user['image'] != null) {
        ?>
            <img src="<?php echo $user['image'] ?>" width="30%" alt="">
        <?php
        } else {
        ?>
            <img src="Image/stock_photo.jpeg" width="30%" alt="">
        <?php
        }
        ?>
        <h1>BIO</h1>
        <?php
        if ($user['bio'] != null) {
        ?>
            <h2><?php echo $user['bio'] ?></h2>
        <?php
        } else {
        ?>
            <h2>You haven't upload your Bio yet</h2>
        <?php
        }
        ?>
        <button class="btn btn-primary" onclick="location.href='edit_profile.php?id=<?php echo $id ?>'">Edit Profile</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>
<script>
    function search() {
        var input = document.getElementById('search').value;
        location.href = "search.php?search=" + input;
    }
</script>

</html>