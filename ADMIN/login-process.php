<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a MySQL database set up
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_burgers";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO: Implement proper validation and security measures

    // Query to fetch user from the admin table
    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, set session and redirect to admin page
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        header("Location: admin.php");
        exit();
    } else {
        // User not found, redirect to login page
        header("Location: admin.php");
        exit();
    }

    $conn->close();
} else {
    // Redirect to login page if not submitted through a form
    header("Location: login.php");
    exit();
}
?>
