<?php
// Include your database connection file
include '../ADMIN/connection-product.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Check if the 'item_id' key exists in the $_POST array
    if (isset($_POST['item_id'])) {
        $itemId = $_POST['item_id'];

        // Fetch data for the selected item
        $query = "SELECT * FROM tbl_items WHERE item_id = $itemId";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Check if a new image file is uploaded
        if (isset($_FILES['new_item_image']) && $_FILES['new_item_image']['error'] === UPLOAD_ERR_OK) {
            // Read the image file
            $imageTmp = file_get_contents($_FILES['new_item_image']['tmp_name']);

            // Convert the image to base64 encoding
            $newItemImage = base64_encode($imageTmp);
        } else {
            // If no new image is uploaded, use the existing image data
            $newItemImage = $row['item_img'];
        }

        // Get other form data
        $itemName = $_POST['item_name'];
        $itemPrice = $_POST['item_price'];
        $categoryId = $_POST['category_id'];
        $availability = $_POST['availability'];

        // Perform the update
        $updateQuery = "UPDATE tbl_items SET 
                        item_name = '$itemName', 
                        item_img = '$newItemImage', 
                        item_price = '$itemPrice', 
                        category_id = '$categoryId', 
                        availability = '$availability' 
                        WHERE item_id = $itemId";

        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Close the database connection
            mysqli_close($conn);

            // Redirect immediately after the update
            header("Location: ../ADMIN/admin.php");
            exit();
        } else {
            echo "Error updating item: " . mysqli_error($conn);
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
