<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iTeachYou</title>
    <link rel="stylesheet" type="text/css" href="/assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
    <!-- Navigation -->
    <header>
        <nav>
            <?php
            session_start();
            if (isset($_SESSION["user_id"])) {
                echo '<a href="logout.php" class="default-button">Logout</a>';
            } else {
                echo '<a href="login.php" class="default-button">Login</a>';
            }
            ?>
        </nav>
    </header>
    <!-- Navigation Ends Here -->