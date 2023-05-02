<?php
include "./inc/header.php";

if (isset($_SESSION["user_id"])) {
    header("Location: home.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include "./inc/connect.php";

    if (isset($_POST['submit'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS);
        $dob = filter_var($_POST['dob'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $type = "S";

        if (!empty($email) && !empty($name) && !empty($surname) && !empty($dob) && !empty($phone) && !empty($password) && !empty($confirm_password)) {
            if (strlen($password) < 5) {
                $message = "<p style='color: red;'>The password must be at least 5 characters long.</p>";
            }
            if ($password !== $confirm_password) {
                $message = "<p style='color: red;'>Passwords must match.</p>";
            } else {
                $sql = "SELECT * FROM users WHERE email =?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if (mysqli_num_rows($result)) {
                    $message = "<p style='color: red;'>Email already taken.</p>";
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (email, name, surname, dob, phone, type, password) VALUES (?, ?, ?, ?, ?, ?,?)";
                    $stmt = $mysqli->prepare($sql);
                    $result = $stmt->bind_param('sssssss', $email, $name, $surname, $dob, $phone, $type, $password);
                    $stmt->execute();
                    $stmt->close();
                    $message = "<p style='color: green;'>Account created successfully.</p>";
                }
            }
        } else {
            $message = "<p style='color: red;'>All inputs must be completed.</p>";
        }
    };
}
?>

<body>
    <section class="full-height">
        <div class="container login">
            <h1>Register</h1>
            <?php echo $message ?? null; ?>
            <form method="post">
                <div>
                    <label for="name">Name: </label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label for="surname">Surname: </label>
                    <input type="text" name="surname" required>
                </div>
                <div>
                    <label for="dob">Date of birth: </label>
                    <input type="date" name="dob" required>
                </div>
                <div>
                    <label for="phone">Phone number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="07700 900123" pattern="(^(07\d{8,12})$)|(^\+44\s7\d{9}$)" required>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email" required>
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm password: </label>
                    <input type="password" name="confirm_password" required>
                </div>
                <button name="submit" class="default-button">Register</button>
            </form>
            <p>Already have an account? Login <a href="login.php">here.</a></p>
        </div>
    </section>
</body>

<?php

include "./inc/footer.php";
