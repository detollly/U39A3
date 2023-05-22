<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $course_id = filter_var($_GET["course_id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $user_id = filter_var($_GET["user_id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_price = filter_var($_GET["course_price"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_teacher = filter_var($_GET["teacher"], FILTER_SANITIZE_SPECIAL_CHARS);

    require "./inc/connect.php";
    $sql = "INSERT INTO enrolment (user_id, course_id, price, teacher_id) VALUES (?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iisi", $user_id, $course_id, $course_price, $course_teacher);
    $stmt->execute();
    $stmt->close();

    header("Location: view-course.php?course_id=$course_id");
}
