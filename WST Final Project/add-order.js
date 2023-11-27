
document.addEventListener('DOMContentLoaded', function () {
    const addToOrderButtons = document.querySelectorAll('.add-to-order-button');

    button.addEventListener('click', function () {
        const productName = button.dataset.productName;
        const productImg = button.dataset.productImg; // Corrected attribute name
        const productPrice = button.dataset.productPrice;

        // Call a function to add the item to the order form
        addToOrder(productName, productImg, productPrice);
    });
});

// Function to add items to the order form
function addToOrder(productName, productPrice) {
    const orderItemsContainer = document.getElementById('order-items');
    const row = document.createElement('tr');
    row.innerHTML = `<td>${productName}</td><td>${productPrice}</td><td><input type="number" name="quantity[]" value="1" min="1"></td>`;
    orderItemsContainer.appendChild(row);
}
