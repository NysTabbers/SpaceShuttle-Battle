<?php

$name = "localhost";
$user = "root";
$password = "";
$db = "spaceship";

$con = new mysqli($name, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

?>