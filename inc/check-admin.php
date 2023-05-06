<?php
if (isset($_SESSION["user_id"])) {
    include "./inc/get-user-data.php";

    if ($user["type"] == 'S') {
        header("Location: index");
        exit;
    };
} else {
    header("Location: login.php");
    exit;
}
