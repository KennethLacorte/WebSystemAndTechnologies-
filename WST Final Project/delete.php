<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $orderId = $_POST['order_id'];

    // Delete order from the database
    $sql = "DELETE FROM orders WHERE id = $orderId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Order deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting order: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
