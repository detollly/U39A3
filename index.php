<?php
include "./inc/header.php";
require "./inc/connect.php";
require "./inc/check-admin.php";

//Check user type
if (isset($_SESSION["user_id"])) {
    require "./inc/get-user-data.php";
    echo "Hello " . $user['name'];
} else {
    echo "You are not logged in.";
};
?>

<div class="d-flex gap-2 my-5">
    <?php
    //Get the courses
    $sql = "SELECT * FROM courses";
    $courses = $mysqli->query($sql);

    while ($course = $courses->fetch_assoc()) {
        $course_id = $course["id"];
        $course_title = $course["name"];

        //Get lesson video link
        $sql = "SELECT * FROM lessons WHERE course_id = $course_id LIMIT 1";
        $lessons = $mysqli->query($sql);
        $lesson = $lessons->fetch_assoc();
        $lesson_video_url = $lesson["video"];
        $lesson_description = $lesson["description"];

        $api_key = "enter here";
        parse_str(parse_url($lesson_video_url, PHP_URL_QUERY), $params);
        $video_id = $params['v'];
        $url = "https://www.googleapis.com/youtube/v3/videos?id={$video_id}&key={$api_key}&part=snippet";
        $response = file_get_contents($url);
        $data = json_decode($response);

        $thumbnail_url = $data->items[0]->snippet->thumbnails->medium->url;

        echo "
            <div class='card text-dark' style='width: 18rem;'>
                <img class='card-img-top' src='$thumbnail_url' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title text-dark'>$course_title</h5>
                    <p class='card-text'>" . substr($lesson_description, 0, strpos($lesson_description, '.') + 1) . "</p>
                    <a href='#' class='btn btn-primary'>View Course</a>
                </div>
            </div>
            ";
    }
    ?>
</div>