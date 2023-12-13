function showUpdateForm(itemId) {
    // Use AJAX to fetch the existing data from the database
    // Adjust the URL and method based on your server-side implementation
    $.ajax({
        url: 'admin.php', // Replace with your server-side script
        method: 'POST',
        data: { item_id: itemId },
        success: function (data) {
            // Parse the JSON data received from the server
            var itemData = JSON.parse(data);

            // Generate a unique ID for the form
            var formId = `updateForm${itemId}`;

            // Display the form with existing data using SweetAlert2
            Swal.fire({
                title: 'Update Item',
                html: `<form id='${formId}' class='updateForm'>
                        <label for='item_name${itemId}'>Item Name:</label>
                        <input type='text' id='item_name${itemId}' name='item_name' value='${itemData.item_name}' required><br>
            
                        <label for='item_img${itemId}'>Item Image:</label>
                        <input type='file' id='item_img${itemId}' name='item_img'><br>
            
                        <label for='item_price${itemId}'>Item Price:</label>
                        <input type='text' id='item_price${itemId}' name='item_price' value='${itemData.item_price}' required><br>
            
                        <label for='category_id${itemId}'>Category ID:</label>
                        <input type='text' id='category_id${itemId}' name='category_id' value='${itemData.category_id}' required><br>
            
                        <label for='availability${itemId}'>Availability:</label>
                        <input type='text' id='availability${itemId}' name='availability' value='${itemData.availability}' required><br>
            
                        <button type='submit' class='btn btn-success'>Save</button>
                        <button type='button' class='btn btn-secondary' onclick='Swal.close()'>Cancel</button>
                    </form>`,
                showConfirmButton: false,
            });

            // Event delegation for dynamic forms
            $(document).on('submit', `#${formId}`, function (e) {
                e.preventDefault();
                // Implement your update logic here
                // After the update is successful, you can close the SweetAlert
                Swal.close();
            });
        },
        error: function () {
            // Handle the error if the AJAX request fails
            Swal.fire('Error', 'Failed to fetch item data', 'error');
        }
    });
}