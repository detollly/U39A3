<?php include "./inc/header.php"; ?>

<form action="process-add-lesson.php" method="POST" enctype="multipart/form-data">
    <?php
    $course_code = filter_var($_GET["course-code"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_name = urlencode(filter_var($_GET["course-name"], FILTER_SANITIZE_SPECIAL_CHARS));
    $number_of_lessons = filter_var($_GET["lesson-number"], FILTER_SANITIZE_SPECIAL_CHARS);

    for ($lesson = 1; $lesson < intval($number_of_lessons) + 1; $lesson++) {
        echo "  <h2>Lesson $lesson</h2>
            <div>
                <label for='lesson-$lesson-title'>Lesson $lesson title: </label>
                <input type='text' name='lesson-$lesson-title' >
            </div>
            <div>
                <label for='lesson-$lesson-description'>Lesson $lesson description: </label>
                <input type='text' name='lesson-$lesson-description' >
            </div>
            <div>
                <label for='lesson-$lesson-ppt'>Lesson $lesson PowerPoint</label>
                <input type='file' name='lesson-$lesson-ppt' >
            </div>
            <div>
                <label for='lesson-$lesson-pdf'>Lesson $lesson PDF</label>
                <input type='file' name='lesson-$lesson-pdf' >
            </div>
            <div>
                <label for='lesson-$lesson-video-url'>Lesson $lesson video URL: </label>
                <input type='text' name='lesson-$lesson-video-url' >
                <input type='hidden' name='course-code' value=$course_code> 
                <input type='hidden' name='course-name' value=$course_name> 
                <input type='hidden' name='lesson-number' value=$number_of_lessons> 
            </div>";
    }
    ?>
    <input type="submit">
</form>