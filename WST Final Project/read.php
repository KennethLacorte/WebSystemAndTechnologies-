<?php
include 'db_connection.php';

// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $orders]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No orders found']);
}

$conn->close();
?>
