<?php
require "./inc/header.php";
$course_id = $_GET["course_id"];

require "./inc/connect.php";
$sql = "SELECT * FROM courses WHERE id = $course_id";
$result = $mysqli->query($sql);
$course = $result->fetch_assoc();

//Get lesson data
$sql = "SELECT * FROM lessons WHERE course_id = $course_id";
$lessons = $mysqli->query($sql);
?>
<div class="row">
    <div class="col">
        <div class="accordion" id="lessonAccordion">
            <!-- Loop over each lesson and create an accordion item for it -->
            <?php while ($lesson = $lessons->fetch_assoc()) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $lesson['id']; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $lesson['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $lesson['id']; ?>">
                            <?php echo $lesson['title']; ?>
                        </button>
                    </h2>
                    <!-- Add PDF File -->
                    <!-- <a href="#" class="h6 text-dark" download="<?php echo "courses/{$course['name']}/{$lesson['ppt']}"; ?> "><?php echo $lesson["ppt"] ?> </a><br> -->
                    <!-- Add PPT File -->
                    <a href="#" class="h6 text-dark" download="<?php echo $lesson['pdf']; ?>" onclick="this.href='<?php echo './courses/' . $course['name'] . '/' . $lesson['pdf']; ?>'">
                        <?php echo $lesson['pdf']; ?>
                    </a>
                    <div id="collapse<?php echo $lesson['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $lesson['id']; ?>" data-bs-parent="#lessonAccordion">
                        <div class="accordion-body">

                            <button class="btn btn-primary" onclick="changeVideo('<?php echo $lesson['video']; ?>')">Watch Lesson</button>
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