<?php
$conn = new mysqli("localhost", "root", "", "portfolio");
if ($conn->connect_error) {
    die("Database connection failed");
}
?>
