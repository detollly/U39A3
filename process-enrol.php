<?php
require "./inc/header.php";
require "./inc/get-course-date.php";
$course_id = filter_var($_GET["course_id"], FILTER_SANITIZE_SPECIAL_CHARS);
$course = getCourseData($course_id);
?>

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
<section class="content contentContainer mx-auto" style="width: 90%; max-width: 1000px; ">
    <div class="contentContainer">
        <div class="payment">
            <div class="paymentSection">
                <h4 class="bigHeading">Payment</h4>
                <h2>Billing Address</h2>
                <form method="get">
                    <input type="text" id="email" name="email" placeholder=" Email...">
                    <div>
                        <input type="text" id="fname" name="fname" placeholder=" First Name...">
                        <input type="text" id="lname" name="lname" placeholder=" Last Name...">
                    </div>
                    <input type="text" id="address1" name="address1" placeholder=" Address Line 1...">
                    <input type="text" id="address2" name="address2" placeholder=" Address Line 2...">
                    <div>
                        <input type="text" id="country" name="country" placeholder=" Country...">
                        <input type="text" id="postcode" name="postcode" placeholder=" Postcode...">
                    </div>
                    <input type="text" id="phone" name="phone" placeholder=" Phone Number...">
                </form>
                <div class="paymentMethod">
                    <h3>Payment Method</h3>
                    <div>
                        <button class="active"><span><i class="fa-brands fa-cc-visa"></i><i class="fa-brands fa-cc-mastercard"></i></span>Credit/Debit Card</button>
                        <button><span><i class="fa-brands fa-paypal"></i></span>PayPal</button>
                    </div>
                </div>
            </div>
            <div class="paymentSection">
                <h4 class="smallHeading">Payment</h4><br>
                <h2>Order Summary</h2>
                <div class="paymentDescription">
                    <h3> <?php echo $course['name']; ?></h3>
                    <h2 id="price"><?php echo $course['cost']; ?></h2>
                </div>
                <div class="paymentTotal">
                    <h3>Total:</h3>
                    <h3 id="totalPrice"><?php echo $course['cost']; ?></h3>
                </div>
                <form method="post">
                    <button type="submit" id="buyButton">Buy Course</button><br><br>
                </form>

            </div>
        </div>
    </div>
</section>