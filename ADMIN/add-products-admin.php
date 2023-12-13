<?php
// Include your database connection file
include '../ADMIN/connection-product.php';

// Initialize response array
$response = array('success' => false, 'message' => '');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $categoryId = $_POST['categoryId'];
    $availability = $_POST['availability'];

    // Check if the file was uploaded without errors
    if ($_FILES['itemImage']['error'] == UPLOAD_ERR_OK) {
        // Specify the target directory
        $targetDir = "upload/";

        // Create the target directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get the file name and move the uploaded file to the target directory
        $itemImage = file_get_contents($_FILES['itemImage']['tmp_name']);

        // Insert data into the database with BLOB data
        $query = "INSERT INTO tbl_items (item_id, item_name, item_img, item_price, category_id, availability) VALUES ('$itemId', '$itemName', ?, '$itemPrice', '$categoryId', '$availability')";
        $stmt = mysqli_prepare($conn, $query);

        // Bind the BLOB data
        mysqli_stmt_bind_param($stmt, "s", $itemImage);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        // Check the result
        if ($result) {
            $response['success'] = true;
            $response['message'] = "Product added successfully!";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the file upload error
        $response['success'] = false;
        $response['message'] = "File upload error: " . $_FILES['itemImage']['error'];
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the response as JSON
    echo json_encode($response);
}
?>
