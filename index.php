<?php
require "./inc/header.php";
require "./inc/connect.php";
?>
<form method="GET">
    <div class="banner">
        <h1>Your Future Starts Here.</h1>
        <p style="font-size: 1.25rem;">Discover your true potential, use this search bar to find the course that best suits your learning needs.</p>
        <input type="text" name="search" placeholder="Search for a course..." style="min-width: 350px;">
    </div>
    <div class="courseNav" id="courseNav">
        <div>
            <a href="?category=development" class="featuredlink">Web Dev</a>
            <a href="?category=science" class="featuredlink">Data Science</a>
            <a href="?category=cybersecurity" class="featuredlink">Cybersecurity</a>
            <a href="?category=programming" class="featuredlink">Programming</a>
            <a href="?category=databases" class="featuredlink">Databases</a>
        </div>
    </div>
</form>


<section class="content">
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
            echo "<p style='margin: 2rem;'>No results found.<p>";
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
    <div class="contentContainer grid">
        <h2 id="gridTitle"></h2>
        <p id="gridDescription"></p>
        <div class="gridContainer" id="grid">
            <?php
            // Display the search results
            if (!empty($courses)) {
                while ($course = $courses->fetch_assoc()) {
                    $course_id = $course["id"];
                    $course_title = $course["name"];
                    $course_price = $course['cost'];
                    $course_category = $course['category'];

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
                    <div class='gridItem'>
                        <img src='$thumbnail_url' style='max-width: 100%'>
                        <h4>$course_category</h4>
                        <h3>$course_title</h3>
                        <p>" . substr($lesson_description, 0, strpos($lesson_description, '.') + 1) . "</p>
                        <div class='divider'></div>
                        <a href='view-course.php?course_id=$course_id'>View Course</a>
                        <p class='coursePrice'>£$course_price</p>
                    </div>";
                }
            }
            ?>
        </div>
    </div>
</section>
<section class="content" style="margin-block: 5rem;">
    <div class="contentContainer">
        <div class="about">
            <h4>About Us<h4>
                    <h3>So, what is iTeachYou Online? We are a group of students who wanted to create an online
                        learning platform which delivers fast, industry ready courses for a fair price, so we
                        created iTeachYou Online which aims to deliver just that.</h3>
                    <div>
                        <a href="javascript:void(0);" class="button1" onclick="">Contact</a>
                        <a href="javascript:void(0);" class="button2" onclick="">Button</a>
                    </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="contentContainer video">
        <iframe src="https://www.youtube.com/embed/WdC1OPsxWCE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
</section>
<section class="content">
    <div class="contentContainer">
        <h2>Customer testimonials</h2>
        <p style="text-align:center;">Here’s what our customers have said about us and our courses:</p>
        <div class="testimonialContainer">
            <div class="testimonialFlexItem">
                <div class="starRating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>"These courses really helped my development team progress, the courses are industry informative
                    and industry relevant. I would highly recommend."</p>
                <div class="testimonialName">
                    <img src="./images/face1.png">
                    <p><span style="font-weight: bold;">Ralph Fleming,</span><br>
                        CEO, Example.org</p>
                </div>
            </div>
            <div class="testimonialFlexItem">
                <div class="starRating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>"Thanks to ITeachYouOnline I have expanded my web development knowledge and skill set, allowing
                    me to do my job more confidently."</p>
                <div class="testimonialName">
                    <img src="./images/face2.png">
                    <p><span style="font-weight: bold;">Jemma Coffey,</span><br>
                        Developer, Example.org</p>
                </div>
            </div>
            <div class="testimonialFlexItem">
                <div class="starRating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>"My team and I found these courses very helpful, not only are they informative but they do not
                    take long to complete. "</p>
                <div class="testimonialName">
                    <img src="./images/face3.png">
                    <p><span style="font-weight: bold;">Tyler Mccall,</span><br>
                        Manager, Example.org</p>
                </div>
            </div>
        </div>
</section>
<section class="content">
    <div class="contentContainer">
        <div class="contactHeader" id="contact">
            <h6>Contact Form</h6>
            <h2>Contact Us</h2>
            <p>To get in touch use the form below or any of the methods shown:</p>
        </div>
        <div class="contact">
            <div class="contactForm">
                <form action="">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" maxlength="30"><br>
                    <label for="email">E-mail:</label><br>
                    <input type="text" id="email" name="email" maxlength="50"><br>
                    <label for="message">Message:</label><br>
                    <textarea type="text" id="message" name="message" maxlength="512"></textarea><br><br>
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms"> I accept the Terms</label><br><br>
                    <input type="submit" value="Submit" id="submit">
                </form>
            </div>
            <div class="contactInfo">
                <div class="contactIcon">
                    <i class="fa-solid fa-envelope"></i><br>
                    <h3>Email</h3><br>
                    <p>Send us an email at:</p><br>
                    <a href="mailto:iteachyou.c@gmail.com">iteachyou.c@gmail.com</a><br>
                </div>
                <div class="contactIcon">
                    <i class="fa-solid fa-phone"></i>
                    <h3>Phone</h3><br>
                    <p>Call us at (9am-5pm GMT):</p><br>
                    <a>+1 (555) 000 0000</a><br>
                </div>
                <div class="contactIcon">
                    <i class="fa-solid fa-location-dot"></i>
                    <h3>Office</h3><br>
                    <p>Cauldwell St, Bedford, Bedfordshire, UK <br> MK42 9AH (9am-5pm GMT)</p><br>
                    <a href="https://www.google.com/maps/place/Bedford+College/@52.1332005,-0.4704361,17z/data=!4m6!3m5!1s0x4877b6c5c58b8029:0xb3bb616b53ce6739!8m2!3d52.1331972!4d-0.4678612!16s%2Fm%2F03hkfqd">Get
                        Directions</a><br>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
require "./inc/footer.php";
?>