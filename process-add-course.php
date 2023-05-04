<?php
$message;
//CHECK FOR SERVER METHOD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_name = $_POST["course-name"];
    $category = $_POST["category"];
    $cost = $_POST["cost"];
    $teacher_id = $_POST["teacher-id"];
    $language = $_POST["language"];
    $course_code = $_POST["course-code"];
    $students_enrolled = 0;

    if (!empty($course_name) && !empty($category) && !empty($cost) && !empty($teacher_id) && !empty($language) && !empty($course_code)) {
        include "./inc/connect.php";
        $sql = "INSERT INTO courses (name, category, cost, teacher_id, language, students_enrolled, course_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $result = $stmt->bind_param('sssssss', $course_name, $category, $cost, $teacher_id, $language, $students_enrolled, $course_code);
        $stmt->execute();
        $stmt->close();
        header("Location: add-lessons.php?lesson-number={$_POST['lesson-number']}&course-code={$course_code}");
    } else {
        $message = "<p style='color: red;'>All fields must be completed!</p>";
    }
}
