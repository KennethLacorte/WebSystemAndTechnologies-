<?php
// Database configuration
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

$data = json_decode(file_get_contents("php://input"), true);

// Insert data into tbl_customers
$customerName = $data['customerName'];
$orderDate = $data['orderDate'];

$sql = "INSERT INTO tbl_customers (customer_name, order_date) VALUES ('$customerName', '$orderDate')";
if ($conn->query($sql) === TRUE) {
    $customerId = $conn->insert_id;

    // Insert data into tbl_orders
    $orderNumber = $data['orderNumber'];
    $totalPrice = $data['totalPrice'];

    $sqlOrder = "INSERT INTO tbl_orders (order_number, customer_id, totals) VALUES ('$orderNumber', '$customerId', '$totalPrice')";
    if ($conn->query($sqlOrder) === TRUE) {
        $orderId = $conn->insert_id;

        // Insert data into tbl_order_items
        $orderItems = $data['orderItems'];

        foreach ($orderItems as $item) {
            $itemId = $item['itemId'];
            $quantity = $item['quantity'];

            $sqlOrderItem = "INSERT INTO tbl_order_items (order_id, item_id, quantity) VALUES ('$orderId', '$itemId', '$quantity')";
            if ($conn->query($sqlOrderItem) !== TRUE) {
                $response = ["status" => "error", "message" => "Error inserting order item data: " . $conn->error];
                echo json_encode($response);
                exit;
            }
        }

        $response = ["status" => "success", "message" => "Order confirmed and data inserted successfully"];
        echo json_encode($response);
    } else {
        $response = ["status" => "error", "message" => "Error inserting order data: " . $conn->error];
        echo json_encode($response);
    }
} else {
    $response = ["status" => "error", "message" => "Error inserting customer data: " . $conn->error];
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
