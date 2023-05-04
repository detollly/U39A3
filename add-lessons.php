<?php
include "./inc/header.php";
$course_code = $_GET["course-code"];
$number_of_lessons = $_GET["lesson-number"];

for ($lesson = 1; $lesson < intval($number_of_lessons) + 1; $lesson++) {
    echo "
        <div>
            <h2>Lesson $lesson</h2>
            <div>
                <label for='lesson-$lesson-title'>Lesson $lesson title: </label>
                <input type='text' name='lesson-$lesson-title' required>
            </div>
            <div>
                <label for='lesson-$lesson-description'>Lesson $lesson description: </label>
                <input type='text' name='lesson-$lesson-description' required>
            </div>
            <div>
                <label for='lesson-$lesson-ppt'>Lesson $lesson PowerPoint</label>
                <input type='file' name='lesson-$lesson-ppt' required>
            </div>
            <div>
                <label for='lesson-$lesson-pdf'>Lesson $lesson PDF</label>
                <input type='file' name='lesson-$lesson-pdf' required>
            </div>
            <div>
                <label for='lesson-$lesson-video-url'>Lesson $lesson video URL: </label>
                <input type='text' name='lesson-$lesson-video-url' required>
            </div>
        </>";
}
