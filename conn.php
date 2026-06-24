<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "db_agenda";
$conn = new mysqli($hostname, $username, $password, $database);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die("". $conn->connect_error);
}