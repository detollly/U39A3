<?php
function getCourseData($course_id)
{
    // Connect to the database (assuming you have a valid $mysqli connection)
    include "./inc/connect.php";

    // Prepare the SQL query
    $stmt = $mysqli->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the course data
    $course = $result->fetch_assoc();

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();

    // Return the course data
    return $course;
}
