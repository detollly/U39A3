<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iTeachYou</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <script src="./assets/script.js" defer></script>
    <link rel="stylesheet" type="text/css" href="./assets/styles.css">

</head>

<body>
    <!-- Navigation -->
    <header>
        <nav>
            <?php
            session_start();
            session_regenerate_id();
            if (isset($_SESSION["user_id"])) {
                include "./inc/get-user-data.php";
            }  ?>
            <div class="nav" id="Top">
                <a href="javascript:void(0);" style="font-size:24px;" class="icon" onclick="hamburgerMenu()">&#9776;</a><!--Hamburger menu-->
                <a id="homeLink" href="index" style="margin-top: 0.35rem;"><object type="image/svg+xml" data="./images/logo.svg" width="auto" height="50px" style="pointer-events: none;"></object></a>
                <a href="index">Homepage</a>
                <a href="index#courseNav">Courses</a>
                <a href="index#contact">Contact Us</a>
                <?php

                if (!isset($_SESSION["user_id"])) {
                    echo '<a id="login" href="login">Login</a>';
                    echo '<a id="signUp" href="register">Sign Up</a>';
                }

                if (isset($_SESSION["user_id"])) {
                    echo '<a href="account" ><i class="fa-solid fa-user"></i></a>';
                    if ($user["type"] === "A"  || $user["type"] === "T") {
                        echo "<a role='button' id='login' href=./upload-course.php>Upload</a>";
                    }
                    echo '<a href="logout.php" id="signUp">Logout</a>';
                }
                ?>
            </div>
        </nav>
    </header>
    <!-- Navigation Ends Here -->