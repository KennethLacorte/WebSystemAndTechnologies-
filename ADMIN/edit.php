<?php

include '../ADMIN/connection-product.php';

// Check if the item ID is provided
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    $query = "SELECT * FROM tbl_items WHERE item_id = $itemId";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    mysqli_close($conn);
} else {
    
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Edit Item</title>
</head>

<body>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Item Information</h3>
        </div>

        <div id="edit-product-content" class="container d-flex justify-content-center">
            <table class="table bg-white rounded shadow-sm table-hover">
                
            </table>
        </div>

        <div id="edit-form-container" class="container d-flex justify-content-center">
            <form action="update.php" method="post" style="width:50vw; min-width:300px;">
                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Item Name:</label>
                        <input type="text" class="form-control" name="item_name" value="<?php echo $row['item_name']; ?>">
                    </div>

                    
                    <div class="col">
                        <label class="form-label">Item Image:</label>
                        <input type="file" class="form-control" name="new_item_image">
                        <?php if (isset($row['item_image'])) : ?>
                            <img src="<?php echo $row['item_image']; ?>" alt="Current Image" width="50">
                            <input type="hidden" name="item_image" value="<?php echo $row['item_image']; ?>">
                        <?php endif; ?>
                    </div>

                    <div class="col">
                        <label class="form-label">Item Price:</label>
                        <input type="text" class="form-control" name="item_price" value="<?php echo $row['item_price']; ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Category ID:</label>
                        <input type="text" class="form-control" name="category_id" value="<?php echo $row['category_id']; ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Availability:</label>
                        <input type="text" class="form-control" name="availability" value="<?php echo $row['availability']; ?>">
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit" onclick="showAlert()">Update</button>
                    <a href="admin.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
    function showAlert() {
        Swal.fire({
            title: 'Item Updated',
            text: 'The item has been updated successfully!',
            icon: 'success'
        }).then(() => {
            // Redirect to another page after user interaction
            window.location.href = "../ADMIN/admin.php";
        });
    }
</script>

</body>

</html>
