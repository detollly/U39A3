<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iTeachYou</title>
    <link rel="stylesheet" type="text/css" href="/assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- Navigation -->
    <header>
        <nav style="display: flex; justify-content: space-between;">
            <?php
            session_start();
            session_regenerate_id();
            if (isset($_SESSION["user_id"])) {
                echo '
                <div class="d-flex w-100 justify-content-between">
                    <a href="logout.php" class="btn btn-secondary">Logout</a>
                    <div>
                        <a href="index" class="mx-5">Home</a>
                        <a href="account" class="btn btn-secondary mx-2"><i class="fa-solid fa-user"></i></a>
                    </div>
                    
                </div>';

                include "./inc/get-user-data.php";
                if ($user["type"] === "A"  || $user["type"] === "T") {
                    echo "<a role='button' class='btn btn-primary' href=./upload-course.php>Upload</a>";
                }
            } else {
                echo '<a href="login.php" class="btn btn-primary">Login</a>';
            }
            ?>
        </nav>
    </header>
    <!-- Navigation Ends Here -->