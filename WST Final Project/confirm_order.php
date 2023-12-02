<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_burgers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error)));
}

// Retrieve data from the AJAX request
$customerName = $_POST['customerName'];
$orderDate = $_POST['orderDate'];
$orderNumber = $_POST['orderNumber'];
$products = isset($_POST['products']) ? $_POST['products'] : [];

try {
    // Insert data into tbl_customers
    $sqlInsertCustomer = "INSERT INTO tbl_customers (customer_name, order_date, order_number) VALUES ('$customerName', '$orderDate', '$orderNumber')";
    if ($conn->query($sqlInsertCustomer) !== TRUE) {
        throw new Exception('Error inserting into tbl_customers: ' . $conn->error);
    }

    // If the insertion is successful, retrieve the customer ID
    $customerId = $conn->insert_id;

    // Generate a unique order number using customer ID and a random number
    $orderNumber = generateOrderNumber($customerId);

    // Insert data into tbl_orders
    $sqlInsertOrder = "INSERT INTO tbl_orders (customer_id, order_number) VALUES ('$customerId', '$orderNumber')";
    if ($conn->query($sqlInsertOrder) !== TRUE) {
        throw new Exception('Error inserting into tbl_orders: ' . $conn->error);
    }

    // If the insertion into tbl_orders is also successful, retrieve the order ID
    $orderId = $conn->insert_id;

    // Insert or update data into tblorderitems (assuming $products is an array containing item_id and quantity)
    foreach ($products as $product) {
        $productId = $product['item_id'];
        $quantity = $product['quantity'];

        // Check if the item already exists in tblorderitems
        $sqlCheckItem = "SELECT * FROM tblorderitems WHERE order_id = '$orderId' AND item_id = '$productId'";
        $result = $conn->query($sqlCheckItem);

        if ($result->num_rows > 0) {
            // If the item already exists, update the quantity
            $sqlUpdateQuantity = "UPDATE tblorderitems SET quantity = quantity + '$quantity' WHERE order_id = '$orderId' AND item_id = '$productId'";
            if ($conn->query($sqlUpdateQuantity) !== TRUE) {
                throw new Exception('Error updating quantity in tblorderitems: ' . $conn->error);
            }
        } else {
            // If the item does not exist, insert the new item
            $sqlInsertOrderItem = "INSERT INTO tblorderitems (order_id, item_id, quantity) VALUES ('$orderId', '$productId', '$quantity')";
            if ($conn->query($sqlInsertOrderItem) !== TRUE) {
                throw new Exception('Error inserting into tblorderitems: ' . $conn->error);
            }
        }
    }

    // If everything is successful, you can perform additional actions if needed
    echo json_encode(array('status' => 'success', 'message' => 'Order placed successfully.'));
} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Close the database connection
$conn->close();

function generateOrderNumber($customerId) {
    // Combine customer ID with a random number
    return $customerId . rand(1000, 9999); // Adjust as needed
}
?>
