<?php
include "./inc/header.php";
include "./inc/connect.php";
if (isset($_SESSION["user_id"])) {
    echo $_SESSION["user_id"];
    echo "<a href=./upload-course.php>Upload</a>";
} else {
    echo "You are not logged in.";
};
