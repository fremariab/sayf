<?php
$servername = "127.0.0.1";
$username = "root";
$password = "!kwqFYObck=6";
$database = "sayf_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}