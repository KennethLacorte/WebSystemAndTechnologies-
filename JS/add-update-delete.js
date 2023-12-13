document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from the server
    fetchItems();
});

function fetchItems() {
    // Replace 'your_api_endpoint' with the actual API endpoint
    fetch('your_api_endpoint')
        .then(response => response.json())
        .then(data => {
            // Process the fetched data and update the table
            updateTable(data);
        })
        .catch(error => console.error('Error fetching data:', error));
}

function updateTable(items) {
    // Clear existing table rows
    var tableBody = document.getElementById('itemsTableBody');
    tableBody.innerHTML = '';

    // Loop through the items and append rows to the table
    items.forEach(item => {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.itemId}</td>
            <td>${item.itemName}</td>
            <td><img src="${item.itemImageUrl}" alt="Product Image" width="50"></td>
            <td>${item.itemPrice}</td>
            <td>${item.categoryId}</td>
            <td>${item.availability}</td>
            <td>
                <button class="btn btn-success" onclick="addItem(${item.itemId})">Add</button>
                <button class="btn btn-primary" onclick="updateItem(${item.itemId})">Update</button>
                <button class="btn btn-danger" onclick="deleteItem(${item.itemId})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function addItem(itemId) {
    // Implement logic to add item on the server
    console.log('Adding item with ID ' + itemId);
}

function updateItem(itemId) {
    // Implement logic to update item on the server
    console.log('Updating item with ID ' + itemId);
}
function deleteItem(itemId) {
    // Display SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        // If the user clicks "Yes"
        if (result.isConfirmed) {
            // Perform AJAX request to delete item on the server
            fetch('delete-products.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ itemId: itemId }),
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response, you can show an alert or update the table
                    if (data.success) {
                        // Display success SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Item deleted successfully',
                        }).then(() => {
                            // Remove the deleted item from the table
                            removeTableRow(itemId);
                        });
                    } else {
                        // Display error SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to delete item',
                        });
                    }
                })
                .catch(error => console.error('Error deleting item:', error));
        }
    });
}

// Function to remove the table row with the specified itemId
function removeTableRow(itemId) {
    var tableBody = document.getElementById('itemsTableBody');
    var rows = tableBody.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0 && cells[0].innerText == itemId) {
            tableBody.removeChild(rows[i]);
            break;
        }
    }
}
