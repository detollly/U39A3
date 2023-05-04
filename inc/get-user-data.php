<?php

include "./inc/connect.php";
$sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();
