<?php
$data = json_decode(file_get_contents("php://input"), true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_burgers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customerId = null;

// Insert data into tbl_customers
$customerName = $data['customerName'];
$orderDate = $data['orderDate'];

$sqlCustomer = "INSERT INTO tbl_customers (customer_name, order_date) VALUES ('$customerName', '$orderDate')";
if ($conn->query($sqlCustomer) === TRUE) {
    $customerId = $conn->insert_id;

    // Insert data into tbl_orders
    $orderNumber = $data['orderNumber'];
    $totalPrice = $data['totalPrice'];

    $sqlOrder = "INSERT INTO tbl_orders (order_number, customer_id, totals) VALUES ('$orderNumber', '$customerId', '$totalPrice')";
    if ($conn->query($sqlOrder) === TRUE) {
        $orderId = $conn->insert_id;

        // Insert order items data
        foreach ($data['orderItems'] as $item) {
            $productId = $item['productID'];  // Assuming 'productID' is the correct key
            $quantity = $item['quantity'];

            $sqlOrderItems = "INSERT INTO tbl_order_items (order_id, item_id, quantity) VALUES ('$orderId', '$productId', '$quantity')";

            if (!$conn->query($sqlOrderItems)) {
                $response = ["status" => "error", "message" => "Error inserting order items data: " . $conn->error];
                echo json_encode($response);
                exit;
            }
        }

        // Fetch order items data for response
        $sqlFetchOrderItems = "SELECT oi.quantity, i.item_id, i.item_name, i.item_price
                              FROM tbl_order_items oi
                              JOIN tbl_items i ON oi.item_id = i.item_id
                              WHERE oi.order_id = '$orderId'
                              ORDER BY oi.order_item_id";

        $orderItemsResult = $conn->query($sqlFetchOrderItems);

        $orderItemsData = [];
        while ($itemData = $orderItemsResult->fetch_assoc()) {
            $orderItemsData[] = $itemData;
        }

        $response = [
            "status" => "success",
            "message" => "Order confirmed and data inserted successfully",
            "orderItemsData" => $orderItemsData
        ];
    } else {
        $response = ["status" => "error", "message" => "Error inserting order data: " . $conn->error];
    }
} else {
    $response = ["status" => "error", "message" => "Error inserting customer data: " . $conn->error];
}

closeConnection($conn);

echo json_encode($response);

function closeConnection($conn)
{
    $conn->close();
}
?>
