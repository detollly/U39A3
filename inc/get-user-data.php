<?php

if (isset($_SESSION['user_id'])) {
    include "./inc/connect.php";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
} else {
    exit("User not found!");
}
