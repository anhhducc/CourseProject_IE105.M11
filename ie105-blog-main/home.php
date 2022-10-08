<?php

    session_start();

    $conn = mysqli_connect("localhost", "user", "UserP@ss123", "ie105");

    if ($_SESSION['isAdmin']) {
        $conn = mysqli_connect("localhost", "admin", "AdminP@ss123", "ie105");
    }

    if(!$conn) {
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    // Get data to display on home page
    $sql = "SELECT * FROM Posts";
    $query = mysqli_query($conn, $sql);

    // Search posts
    if(isset($_REQUEST['search'])){
        $title = addcslashes(mysqli_real_escape_string($conn, $_REQUEST['title']), "%_");
        $sql = "SELECT * FROM Posts WHERE title LIKE '%$title%'";
        $query = mysqli_query($conn, $sql);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Blog using PHP & MySQL</title>
</head>
<body>
    <nav class="topnav">
        <a class="active home" href="home.php">Home</a>
        <a href="index.php">Sign out</a>
        <div class="search-container">
            <form method="POST">
                <input type="text" placeholder="Search.." name="title">
                <button type="submit" name="search">Submit</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">

        <!-- Display any info -->
        <?php if(isset($_REQUEST['info'])){ ?>
            <?php if($_REQUEST['info'] === "added"){?>
                <div class="alert alert-success" role="alert">
                    Post has been added successfully
                </div>
            <?php }?>
        <?php } ?>

        <!-- Create a new Post button -->
        <?php if ($_SESSION['isAdmin'] === true) { ?>
            <div class="text-center">
                <a href="create.php" class="btn btn-outline-dark">+ Create a new post</a>
            </div>
        <?php } ?>
        
        <!-- Display posts from database -->
        <div class="row">
            <?php foreach($query as $q){ ?>
                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <div class="card text-white bg-dark mt-5" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $q['title'];?></h5>
                            <p class="card-text"><?php echo substr($q['content'], 0, 50);?>...</p>
                            <a href="view.php?id=<?php echo $q['id']?>" class="btn btn-light">Read More <span class="text-danger">&rarr;</span></a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="main.js"></script>
</body>
</html>


