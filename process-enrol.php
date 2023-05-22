<?php
require "./inc/header.php";
require "./inc/get-course-date.php";
$course_id = filter_var($_GET["course_id"], FILTER_SANITIZE_SPECIAL_CHARS);

$course = getCourseData($course_id);
?>
<div class="d-flex justify-content-between">
    <div>
        <form method="post">
            <h1>Payment details</h1>
            <div>
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number">
            </div>
            <div>
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY">
            </div>
            <div>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv">
            </div>
            <div>
                <label for="cardholder_name">Cardholder Name:</label>
                <input type="text" id="cardholder_name" name="cardholder_name">
            </div>
            <div>
                <input type="submit" value="Purchase">
            </div>
        </form>
    </div>
    <div class="d-flex flex-column">
        <h2>Course Summary</h2>
        <h3> <?php echo $course['name']; ?></h3>
        <p> <?php echo $course['category']; ?></p>
        <p>Total: <?php echo $course['cost']; ?></p>
    </div>
</div>






<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
?>