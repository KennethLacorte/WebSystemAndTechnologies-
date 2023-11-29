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

// Insert data into the tbl_customers
$sqlInsertCustomer = "INSERT INTO tbl_customers (customer_name, order_date) VALUES ('$customerName', '$orderDate')";

if ($conn->query($sqlInsertCustomer) === TRUE) {
    // If the insertion is successful, retrieve the customer ID
    $customerId = $conn->insert_id;

    // Generate a unique order number using customer ID and a random number
    $orderNumber = generateOrderNumber($customerId);

    // Update the order number in tbl_customers
    $sqlUpdateOrderNumber = "UPDATE tbl_customers SET order_number = '$orderNumber' WHERE customer_id = $customerId";
    
    if ($conn->query($sqlUpdateOrderNumber) === TRUE) {
        // Return the response with customer ID and order number
        echo json_encode(array('status' => 'success', 'customerId' => $customerId, 'orderNumber' => $orderNumber));
    } else {
        // If there's an error in updating order number, return an error status
        echo json_encode(array('status' => 'error', 'message' => $conn->error));
    }
} else {
    // If there's an error in inserting customer information, return an error status
    echo json_encode(array('status' => 'error', 'message' => $conn->error));
}

// Close the database connection
$conn->close();

function generateOrderNumber($customerId) {
    // Combine customer ID with a random number
    return $customerId . rand(1000, 9999); // Adjust as needed
}
?>
