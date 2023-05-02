<?php
include "./inc/header.php";
include "./inc/connect.php";
if (isset($_SESSION["user_id"])) {
    echo $_SESSION["user_id"];
} else {
    echo "Login";
};
