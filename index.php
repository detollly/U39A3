<?php
require "./inc/header.php";
require "./inc/connect.php";
?>
<form method="GET" class="w-100 my-5">
    <div class="d-flex justify-content-center">
        <input type="text" name="search" placeholder="Search for a course..." class="w-50">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div>
        <ul class="list-unstyled d-flex justify-content-evenly mt-5">
            <li><a href="?category=development">Web Development</a></li>
            <li><a href="?category=science">Data Science</a></li>
            <li><a href="?category=cybersecurity">Cybersecurity</a></li>
            <li><a href="?category=programming">Programming</a></li>
        </ul>
    </div>
</form>

<?php
$lessons;
$query;
$courses;

if (isset($_GET['search'])) {
    $query = $mysqli->real_escape_string($_GET['search']);
    // Construct the SQL query to search for courses
    $sql = "SELECT DISTINCT course_id FROM lessons WHERE description LIKE '%$query%' OR title LIKE '%$query%'";
    $lessons = $mysqli->query($sql);
    if ($lessons->num_rows > 0) {
        while ($row = $lessons->fetch_assoc()) {
            $sql = "SELECT * FROM courses WHERE id = {$row['course_id']} OR category LIKE '%$query%'";
            $courses = $mysqli->query($sql);
        }
    } else {
        echo "No results found.";
    }
} elseif (isset($_GET['category'])) {
    $query = $mysqli->real_escape_string($_GET['category']);
    // Construct the SQL query to search for course category
    $sql = "SELECT *  FROM courses WHERE category LIKE '%$query%'";
    $courses = $mysqli->query($sql);
} else {
    $sql = "SELECT * FROM courses ORDER BY RAND() LIMIT 8"; // Fetch 8 random courses
    $courses = $mysqli->query($sql);
}
?>

<div class='d-flex flex-wrap justify-content-center gap-5 my-5'>
    <?php
    // Display the search results
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
            <div class='card text-dark' style='width: 18rem;'>
                <img class='card-img-top' src='$thumbnail_url' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title text-dark'>$course_title</h5>
                    <p class='card-text'>" . substr($lesson_description, 0, strpos($lesson_description, '.') + 1) . "</p>
                    <div class='d-flex justify-content-between align-items-start'>
                        <a href='view-course.php?course_id=$course_id'class='btn btn-primary'>View Course</a>
                        <p class='btn btn-danger'>£$course_price</p>
                    </div>
                </div>
            </div>
        ";
        }
    }
    ?>
</div>