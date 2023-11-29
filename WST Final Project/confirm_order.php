<?php
// Assuming your database connection details
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

// Retrieve data from the form
$customerName = $_POST['customer-name'];
$orderDate = $_POST['order-date'];

// Insert data into the database
$sql = "INSERT INTO tbl_customers (customer_name, order_date) VALUES ('$customerName', '$orderDate')";

if ($conn->query($sql) === TRUE) {
    // If the insertion is successful, return the order number
    $orderNumber = generateOrderNumber();
    echo json_encode(array('status' => 'success', 'orderNumber' => $orderNumber));
} else {
    // If there's an error, return an error status
    echo json_encode(array('status' => 'error', 'message' => $conn->error));
}

// Close the database connection
$conn->close();

function generateOrderNumber() {
    return rand(100000, 999999); // Adjust as needed
}
?>
