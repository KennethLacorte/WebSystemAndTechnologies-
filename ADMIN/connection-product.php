<?php
    $host = 'localhost';   // Replace with your actual database host
    $username = 'root';   // Replace with your actual database username
    $password = '';   // Replace with your actual database password
    $database = 'db_burgers';   // Replace with your actual database name

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
