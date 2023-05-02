<?php

$host = 'localhost';
$name = 'root';
$password = '';
$database = 'iteach';

try {
    $mysqli = new mysqli(hostname: $host, username: $name, password: $password, database: $database);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
