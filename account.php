<?php
require "./inc/header.php";
require "./inc/get-user-data.php";
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<div class="d-flex w-100 flex-column align-items-center">
    <?php
    echo "<div class='w-50 d-flex flex-column'>
    <hr>
    <p>Name: $user[name] </p><hr>
    <p>Surname: $user[surname]</p><hr>
    <p>Email address: $user[email]</p><hr>
    <p>Date of birth: $user[dob] </p><hr>
    <p>Phone: $user[phone]</p> <hr>";

    if ($user["type"] === 'A') {
        echo "<p>Account type: <span class='text-danger'>Admin</span></p><hr>";
    } elseif ($user["type"] === 'T') {
        echo "<p>Account type: <span class='text-primary'>Teacher</span></p><hr>";
    } elseif ($user["type"] === 'S') {
        echo "<p>Account type: <span class='text-success'>Student</span></p><hr>";
    }

    echo "</div>";
    ?>
    <div class="d-flex flex-wrap justify-content-center gap-5 my-5">
        <?php
        $sql = "SELECT * FROM enrolment WHERE user_id=$user[id]";
        $enrolments = $mysqli->query($sql);
        $courses;

        while ($enrolment = $enrolments->fetch_assoc()) {
            $sql = "SELECT * FROM courses WHERE id=$enrolment[course_id]";
            $courses = $mysqli->query($sql);
            if (!empty($courses)) {
                while ($course = $courses->fetch_assoc()) {
                    $course_id = $course["id"];
                    $course_title = $course["name"];
                    $course_price = $course['cost'];

                    //Get lesson video link
                    $sql = "SELECT * FROM lessons WHERE course_id = $course_id LIMIT 1";
                    $lessons = $mysqli->query($sql);
                    $lesson = $lessons->fetch_assoc();
                    $lesson_video_url = $lesson["video"];
                    $lesson_description = $lesson["description"];

                    //Get API key
                    require_once "./config.php";

                    parse_str(parse_url($lesson_video_url, PHP_URL_QUERY), $params);
                    $video_id = $params['v'];
                    $url = "https://www.googleapis.com/youtube/v3/videos?id={$video_id}&key={$api_key}&part=snippet";
                    $response = file_get_contents($url);
                    $data = json_decode($response);

                    $thumbnail_url = $data->items[0]->snippet->thumbnails->medium->url;

                    echo "
                    <div class='gridItem'>
                        <img src='$thumbnail_url' style='max-width: 100%'>
                        <h3 style='margin-top: 1rem'>$course_title</h3>
                        <p>" . substr($lesson_description, 0, strpos($lesson_description, '.') + 1) . "</p>
                        <div class='divider'></div>
                        <a href='view-course.php?course_id=$course_id'>View Course</a>
                    </div>
                ";
                }
            }
        }
        ?>
    </div>
</div>