document.addEventListener('DOMContentLoaded', function () {
    const orderItemsContainer = document.getElementById('order-items');

    document.addEventListener('click', function (event) {
        const clickedButton = event.target.closest('.add-to-order-button');

        if (clickedButton) {
            const productName = clickedButton.dataset.productName;
            const productImg = clickedButton.dataset.productImg;
            const productPrice = clickedButton.dataset.productPrice;

            // Check if the item is already in the order
            const existingRow = findExistingRow(productName);

            if (existingRow) {
                // If the item is in the order, update the quantity
                updateQuantity(existingRow);
            } else {
                // If the item is not in the order, add a new row
                addToOrder(productName, productImg, productPrice);
            }
        }
    });
});

// Function to find an existing row with the same product name
function findExistingRow(productName) {
    const rows = document.querySelectorAll('#order-items tr');
    for (const row of rows) {
        if (row.querySelector('td:first-child').textContent === productName) {
            return row;
        }
    }
    return null;
}

// Function to add items to the order form
function addToOrder(productName, productImg, productPrice) {
    const orderItemsContainer = document.getElementById('order-items');
    const row = document.createElement('tr');
    row.innerHTML = `<td>${productName}</td><td>${productPrice}</td><td><input type="number" name="quantity[]" value="1" min="1"></td>`;
    orderItemsContainer.appendChild(row);
}

// Function to update the quantity of an existing item
function updateQuantity(existingRow) {
    const quantityInput = existingRow.querySelector('input[name="quantity[]"]');
    quantityInput.value = parseInt(quantityInput.value) + 0;
}
