 document.addEventListener('DOMContentLoaded', function() {
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
        // Implement logic to delete item on the server
        console.log('Deleting item with ID ' + itemId);
    }