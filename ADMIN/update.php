<?php
// Include your database connection file
include '../ADMIN/connection-product.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Check if the 'item_id' key exists in the $_POST array
    if (isset($_POST['item_id'])) {
        $itemId = $_POST['item_id'];

        // Fetch data for the selected item
        $query = "SELECT * FROM tbl_items WHERE item_id = ?";
        $stmt = mysqli_prepare($conn, $query);

        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $itemId);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        // Check if a new image file is uploaded
        if (isset($_FILES['new_item_image']) && $_FILES['new_item_image']['error'] === UPLOAD_ERR_OK) {
            // Read the image file
            $imageTmp = file_get_contents($_FILES['new_item_image']['tmp_name']);
        } else {
            // If no new image is uploaded, use the existing image data
            $imageTmp = $row['item_img'];
        }

        // Get other form data
        $itemName = $_POST['item_name'];
        $itemPrice = $_POST['item_price'];
        $categoryId = $_POST['category_id'];

        // Check if the submitted availability value is one of the ENUM values
        $allowedAvailabilities = ['Available', 'Not Available'];
        $availability = $_POST['availability'];
        if (!in_array($availability, $allowedAvailabilities)) {
            echo "Invalid availability value.";
            exit();
        }

        // Check if any required fields are empty
        if (empty($itemName) || empty($itemPrice) || empty($categoryId) || empty($availability)) {
            echo "All fields are required.";
        } else {
            // Perform the update using a prepared statement
            $updateQuery = "UPDATE tbl_items SET 
                            item_name = ?, 
                            item_img = ?, 
                            item_price = ?, 
                            category_id = ?, 
                            availability = ? 
                            WHERE item_id = ?";

            $stmt = mysqli_prepare($conn, $updateQuery);

            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "ssdiss", $itemName, $imageTmp, $itemPrice, $categoryId, $availability, $itemId);

            // Execute the statement
            $updateResult = mysqli_stmt_execute($stmt);

            if ($updateResult) {
                // Close the statement
                mysqli_stmt_close($stmt);

                // Close the database connection
                mysqli_close($conn);

                // Redirect immediately after the update
                header("Location: ../ADMIN/admin.php");
                exit();
            } else {
                echo "Error updating item: " . mysqli_error($conn);
            }
        }
    } else {
        // Redirect to the main page if 'item_id' is not set
        header("Location: admin.php");
        exit();
    }
} else {
    // Redirect to the main page if the form is not submitted
    header("Location: admin.php");
    exit();
}
?>
