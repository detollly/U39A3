<?php
include "./inc/header.php";
$message;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Get and validate input data
    $course_name = filter_var($_POST['course-name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $category = filter_var($_POST["category"], FILTER_SANITIZE_SPECIAL_CHARS);
    $cost = filter_var($_POST["cost"], FILTER_SANITIZE_SPECIAL_CHARS);
    $teacher_id = filter_var($_POST["teacher-id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $language = filter_var($_POST["language"], FILTER_SANITIZE_SPECIAL_CHARS);
    $course_code = filter_var($_POST["course-code"], FILTER_SANITIZE_SPECIAL_CHARS);
    $students_enrolled = 0;

    try {
        //Connect to database and start transaction
        include "./inc/connect.php";
        $mysqli->begin_transaction();

        if (!empty($course_name) && !empty($category) && !empty($cost) && !empty($teacher_id) && !empty($language) && !empty($course_code)) {
            //Insert data into the database
            $sql = "INSERT INTO courses (name, category, cost, teacher_id, language, students_enrolled, course_code) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $result = $stmt->bind_param('sssssss', $course_name, $category, $cost, $teacher_id, $language, $students_enrolled, $course_code);
            $stmt->execute();
            $stmt->close();

            //Create course directory
            $course_dir = "./courses/" . $course_name;
            mkdir($course_dir);

            //Commit the transaction
            $mysqli->commit();

            //Redirect
            header("Location: add-lessons.php?lesson-number={$_POST['lesson-number']}&course-code={$course_code}&course-name={$course_name}");
        } else {
            $message = "<p style='color: red;'>All fields must be completed!</p>";
        }
    } catch (Exception $err) {
        $mysqli->rollback();
        echo "Error: " . $err->getMessage();
    } finally {
        $mysqli->close();
    }
}
