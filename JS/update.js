function updateItem(itemId) {
    // Retrieve the updated values from the editable fields
    var itemName = document.getElementById(`item_name_${itemId}`).innerText;
    var itemPrice = document.getElementById(`item_price_${itemId}`).innerText;
    var categoryId = document.getElementById(`category_id_${itemId}`).innerText;
    var availability = document.getElementById(`availability_${itemId}`).innerText;

    
    fetch('update-item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            itemId: itemId,
            itemName: itemName,
            itemPrice: itemPrice,
            categoryId: categoryId,
            availability: availability
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the server
        console.log('Item updated successfully:', data);
    })
    .catch(error => {
        console.error('Error updating item:', error);
    });
}