<?php
require "./inc/header.php";
?>
<div class="my-3">
    <?php
    $success_messages = $_SESSION["success_messages"];
    foreach ($success_messages as $message) {
        echo $message;
    } ?>
</div>
<a href="index.php" class="btn btn-secondary">Home</a>