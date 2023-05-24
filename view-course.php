<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iTeachYou</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css"> -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./assets/styles.css">
    <script src="./assets/script.js" defer></script>
</head>

<style>
    .video-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%;
        /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
    }

    /* Then style the iframe to fit in the container div with full height and width */
    .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
    }

    .enrolBtn {
        text-align: center;
        width: 160px;
        max-width: 160px;
        height: 45px;
        font-size: 16px;
        padding: 10px;
        margin-top: 1rem;
        background-color: white;
        color: #103d88;
        border: 1px solid #103d88;
    }

    .enrolBtn:hover {
        background-color: #103d88;
        color: white;
    }
</style>

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
                <a id="homeLink" href="index"><object type="image/svg+xml" data="./images/logo.svg" width="auto" height="50px" style="pointer-events: none;"></object></a>
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
    <?php
    //Validate course ID
    $course_id = null;
    if (isset($_GET["course_id"])) {
        $course_id = $_GET["course_id"];
    } else {
        exit("Invalid course ID");
    }

    //Establish connection with the database
    require "./inc/connect.php";
    require "./inc/get-course-date.php";

    //Get course data
    $course = getCourseData($course_id);

    if (!$course) {
        exit("Invalid course");
    }

    //Get lesson data
    $sql = "SELECT * FROM lessons WHERE course_id = $course_id";
    $lessons = $mysqli->query($sql);

    $is_enrolled = false;
    $joining_date;

    if (isset($_SESSION["user_id"])) {
        require "./inc/get-user-data.php";
        //Get enrolment data
        $user_id = $user["id"];
        $course_price = $course["cost"];
        $course_teacher = $course["teacher_id"];

        $sql = "SELECT * FROM enrolment WHERE user_id=$user_id";
        $enrolment = $mysqli->query($sql);


        //Loop over each enrolment to check user data
        while ($record = $enrolment->fetch_assoc()) {
            if ($user_id === $record["user_id"] && $course_id === $record["course_id"]) {
                $is_enrolled = true;
                $date_time = $record["joining_date"];
                $joining_date = date('d M Y', strtotime($date_time));
            }
        }
    }
    ?>
    <section class="content contentContainer mx-auto" style="width: 90%; max-width: 1000px; ">
        <div class="w-100 mx-5">
            <div class="row d-flex flex-column">
                <div class="d-flex justify-content-between align-items-end">
                    <div class="d-flex flex-column w-100">
                        <h2><?php echo $course["name"]; ?></h2>
                        <div class="d-flex justify-content-between w-100">
                            <p><?php echo $course["category"]; ?></p>
                            <p>Students enrolled: <?php echo $course["students_enrolled"]; ?> </p>
                        </div>
                    </div>
                    <p class="h4 mb-3" style="margin-left: 2rem;">£<?php echo $course["cost"]; ?></p>
                </div>
                <div class="col video-container">
                    <!-- Create the video player iframe with an initial video -->
                    <?php
                    $lessons->data_seek(0);
                    $lesson = $lessons->fetch_assoc();
                    $lesson_video_url = $lesson["video"];
                    parse_str(parse_url($lesson_video_url, PHP_URL_QUERY), $params);
                    $video_id = $params['v'];
                    ?>
                    <iframe class="responsive-iframe" id="videoPlayer" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                </div>
                <div class="col my-3 d-flex justify-content-start flex-column">
                    <p><?php echo $lesson["description"]; ?></p>
                </div>
                <div class="col w-100">
                    <div class="accordion mb-2" id="lessonAccordion">
                        <!-- Loop over each lesson and create an accordion item for it -->
                        <?php
                        $index = 1;
                        while ($lesson = $lessons->fetch_assoc()) {
                        ?>
                            <div class="accordion-item">
                                <!-- prettier-ignore -->
                                <h2 class="accordion-header" id="heading<?php echo $lesson['id']; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $lesson['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $lesson['id']; ?>">
                                        <?php echo $lesson['title']; ?>
                                    </button>
                                </h2>

                                <?php
                                //Add PDF File
                                if ($lesson["pdf"]) {
                                    if ($is_enrolled) {
                                        $path =  "./courses/" . $course['name'] . "/Lesson " . $index . "/" . $lesson['pdf'];
                                        echo "<a href='$path' class='h6 text-dark m-3' download> PDF File</a>";
                                    } else {
                                        echo "<p class='text-secondary m-3'>PDF File <i class='fa-solid fa-lock mx-2'></i></p>";
                                    }
                                }
                                //Add PDF File
                                if ($lesson["ppt"]) {
                                    if ($is_enrolled) {
                                        $path =  "./courses/" . $course['name'] . "/Lesson " . $index . "/" . $lesson['ppt'];
                                        echo "<a href='$path' class='h6 text-dark m-3' download> PowerPoint File</a>";
                                    } else {

                                        echo "<p class='text-secondary m-3'>PowerPoint File<i class='fa-solid fa-lock mx-2'></i></p>";
                                    }
                                }
                                $index++;
                                ?>

                                <div id="collapse<?php echo $lesson['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $lesson['id']; ?>" data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        <button class="btn btn-primary" <?php echo $is_enrolled ? 'onclick="changeVideo(\'' . $lesson['video'] . '\')"' : "disabled" ?>>Watch Lesson</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col w-100 border d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                <?php

                if (isset($_SESSION["user_id"]) && $is_enrolled === false) {
                    echo "<h3>Sounds good?</h3>";
                    echo "<a href='process-enrol.php?user_id=$user_id&course_id=$course_id&course_price=$course_price&teacher=$course_teacher' class='enrolBtn'>Enroll</a>";
                } elseif (isset($_SESSION["user_id"]) && $is_enrolled === true) {
                    echo "You joined this course on $joining_date.";
                } else {
                    echo '<p><a href="login.php">Log in</a> to enrol!</p>';
                }
                ?>
            </div>
        </div>

    </section>

    <!-- Add the JavaScript function to change the video -->
    <script>
        function changeVideo(videoUrl) {
            var videoId = videoUrl.match(/v=([^&]+)/)[1];
            var videoPlayer = document.getElementById("videoPlayer");
            videoPlayer.src = "https://www.youtube.com/embed/" + videoId;
        }
    </script>

    <?php
    include "./inc/footer.php";

    ?>