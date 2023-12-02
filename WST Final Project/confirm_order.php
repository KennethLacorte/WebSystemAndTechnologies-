<?php
// confirm_order.php

// Ensure you handle errors, sanitize inputs, and use prepared statements to prevent SQL injection.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a MySQL database
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

    // Get the data from the front-end
    $data = json_decode(file_get_contents("php://input"), true);

    $customerName = $data['customerName'];
    $orderDate = $data['orderDate'];
    $orderNumber = $data['orderNumber'];
    $totals = $data['totals']; // Assuming you receive the totals from the front-end

    // Insert data into the tbl_customers table
    $insertCustomerSql = "INSERT INTO tbl_customers (customer_name, order_date) VALUES (?, ?)";
    $stmt = $conn->prepare($insertCustomerSql);
    $stmt->bind_param("ss", $customerName, $orderDate);

    if ($stmt->execute()) {
        $customerId = $conn->insert_id; // Get the last inserted customer ID

        // Insert data into the tbl_orders table
        $insertOrderSql = "INSERT INTO tbl_orders (customer_id, order_number, totals) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertOrderSql);
        $stmt->bind_param("ids", $customerId, $orderNumber, $totals);

        if ($stmt->execute()) {
            // Fetch additional information using INNER JOIN
            $selectSql = "SELECT tbl_customers.customer_name, tbl_orders.order_number, tbl_customers.order_date, tbl_orders.totals
                            FROM tbl_customers
                            INNER JOIN tbl_orders ON tbl_customers.customer_id = tbl_orders.customer_id
                            WHERE tbl_orders.order_number = ?";
            
            $stmt = $conn->prepare($selectSql);
            $stmt->bind_param("s", $orderNumber);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $orderDetails = $result->fetch_assoc();
                // Return a success response with order details
                echo json_encode(['success' => true, 'orderDetails' => $orderDetails]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error fetching order details']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Error inserting into tbl_orders: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Error inserting into tbl_customers: ' . $stmt->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>
