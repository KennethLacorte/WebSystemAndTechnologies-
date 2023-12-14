<?php

include '../ADMIN/connection-product.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data sent from the frontend
    $data = json_decode(file_get_contents('php://input'), true);

    // Get the item ID from the decoded data
    $itemId = $data['itemId'];

    // Perform the deletion in the database
    $query = "DELETE FROM tbl_items WHERE item_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $itemId);

    if ($stmt->execute()) {
        // If deletion is successful, send a success response
        echo json_encode(['success' => true, 'message' => 'Item deleted successfully']);
    } else {
        // If deletion fails, send an error response
        echo json_encode(['success' => false, 'message' => 'Failed to delete item']);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If the request is not a POST request, return an error response
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// Close the database connection
mysqli_close($conn);
?>
