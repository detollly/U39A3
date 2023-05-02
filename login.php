<?php
include "./inc/header.php";

if (isset($_SESSION["user_id"])) {
    header("Location: index");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "./inc/connect.php";

    $sql = sprintf(
        "SELECT * FROM users WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["password"])) {
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: index");
            print_r($_SESSION["user_id"]);
            exit;
        } else {
            $message = "<p style='color: red;'>Incorrect details. Please try again.</p>";
        }
    }
} ?>

<section>
    <div>
        <h1>Login</h1>
        <?php echo $message ?? null; ?>
        <form method="post">
            <div>
                <label for="email">Email: </label>
                <input type="text" name="email" required>
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" name="password" required>
            </div>

            <button name="submit">Login</button>
        </form>
        <p>Don't have an account? Register <a href="register.php">here.</a></p>
    </div>
</section>

<?php include "./inc/footer.php"; ?>