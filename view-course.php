<?php
require "./inc/header.php";

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

<div class="row d-flex flex-row-reverse">
    <div class="d-flex justify-content-between align-items-end">
        <div class="d-flex flex-column">
            <h2><?php echo $course["name"]; ?></h2>
            <div class="d-flex justify-content-between ">
                <p><?php echo $course["category"]; ?></p>
                <p>Students enrolled: <?php echo $course["students_enrolled"]; ?> </p>
            </div>
        </div>

        <p class="btn btn-danger">£<?php echo $course["cost"]; ?></p>
    </div>
    <div class="col">
        <div class="accordion" id="lessonAccordion">
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
                            print $index;
                            $path =  "./courses/" . $course['name'] . "/Lesson " . $index . "/" . $lesson['pdf'];
                            echo "<a href='$path' class='h6 text-dark' download> PDF File</a>";
                        } else {
                            echo "<p class='text-secondary'>PDF File <i class='fa-solid fa-lock mx-2'></i></p>";
                        }
                    }
                    //Add PDF File

                    if ($lesson["ppt"]) {
                        if ($is_enrolled) {
                            print $index;
                            $path =  "./courses/" . $course['name'] . "/Lesson " . $index . "/" . $lesson['ppt'];
                            echo "<a href='$path' class='h6 text-dark' download> PowerPoint File</a>";
                        } else {

                            echo "<p class='text-secondary'>PowerPoint File<i class='fa-solid fa-lock mx-2'></i></p>";
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
    <div class="col">
        <!-- Create the video player iframe with an initial video -->
        <?php
        $lessons->data_seek(0);
        $lesson = $lessons->fetch_assoc();
        $lesson_video_url = $lesson["video"];
        parse_str(parse_url($lesson_video_url, PHP_URL_QUERY), $params);
        $video_id = $params['v'];
        ?>
        <iframe id="videoPlayer" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p><?php echo $lesson["description"]; ?></p>
    </div>

    <div>
        <?php

        // if ($course_teacher === $user_id) {
        //     echo "You are the creator of this course";
        // } else

        if (isset($_SESSION["user_id"]) && $is_enrolled === false) {
            echo "<a href='process-enrol.php?user_id=$user_id&course_id=$course_id&course_price=$course_price&teacher=$course_teacher' class='btn btn-dark'>Enroll</a>";
        } elseif (isset($_SESSION["user_id"]) && $is_enrolled === true) {
            echo "You joined this course on $joining_date.";
        } else {
            echo '<p><a href="login.php">Log in</a> to enrol!</p>';
        }
        ?>
    </div>
</div>
</div>




<!-- Add the JavaScript function to change the video -->
<script>
    function changeVideo(videoUrl) {
        var videoId = videoUrl.match(/v=([^&]+)/)[1];
        var videoPlayer = document.getElementById("videoPlayer");
        videoPlayer.src = "https://www.youtube.com/embed/" + videoId;
    }
</script>