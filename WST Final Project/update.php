<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $orderId = $_POST['order_id'];
    $newQuantity = $_POST['new_quantity'];

    // Update quantity in the database
    $sql = "UPDATE orders SET quantity = $newQuantity WHERE id = $orderId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Quantity updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating quantity: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
