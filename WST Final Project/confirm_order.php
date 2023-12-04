<?php
$data = json_decode(file_get_contents("php://input"), true);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_burgers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn) {
    $customerId = null;

    // Insert data into tbl_customers
    $customerName = $data['customerName'];
    $orderDate = $data['orderDate'];

    $sqlCustomer = "INSERT INTO tbl_customers (customer_name, order_date) VALUES ('$customerName', '$orderDate')";
    if ($conn->query($sqlCustomer) === TRUE) {
        $customerId = $conn->insert_id;

    // Insert data into tbl_orders
    $orderNumber = $data['orderNumber'];
    $totalPrice = $data['totalPrice'];  // Fix the key name to totalPrice

    $sqlOrder = "INSERT INTO tbl_orders (order_number, customer_id, totals) VALUES ('$orderNumber', '$customerId', '$totalPrice')";
    if ($conn->query($sqlOrder) === TRUE) {
        $response = ["status" => "success", "message" => "Order confirmed and data inserted successfully"];
        echo json_encode($response);
    } else {
        $response = ["status" => "error", "message" => "Error inserting order data: " . $conn->error];
        echo json_encode($response);
    }
} else {
    $response = ["status" => "error", "message" => "Error inserting customer data: " . $conn->error];
    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Database connection error"]);
}

function insertOrderItemsData($conn, $orderItems, $orderId) {
    foreach ($orderItems as $item) {
        $itemID = $item['itemID'];
        $quantity = $item['quantity'];

        // Assuming tbl_items has item_id column
        $sqlOrderItems = "INSERT INTO tbl_order_items (order_id, item_id, quantity) VALUES ('$orderId', '$itemID', '$quantity')";

        if (!$conn->query($sqlOrderItems)) {
            return false;
        }
    }

    return true;
}
?>
