document.addEventListener('DOMContentLoaded', function() {
    const addToOrderButtons = document.querySelectorAll('.add-to-order-button');
    const orderItemsContainer = document.getElementById('order-items');
    const customerInfoForm = document.getElementById('confirm-order-form');
    const overallTotalElement = document.getElementById('overall-total');

    customerInfoForm.style.display = 'none';
    let overallTotal = 0.00;

    // Define an object to store quantities for each product
    const productQuantities = {};

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!button.disabled) {
                const productId = button.dataset.productId;
                const productName = button.dataset.productName;
                const productPrice = parseFloat(button.dataset.productPrice);
                const itemId = button.dataset.itemId; // Add item_id to the dataset

                addToOrder(productName, productPrice, productId, itemId);

                button.disabled = true;
                showCustomerInfoForm();
            }
        });
    });

    function addToOrder(productName, productPrice, productId, itemId) {
        const row = document.createElement('tr');
        const originalPrice = productPrice;
    
        // Initialize quantity to 1 or use the existing quantity if it's already set
        const quantity = productQuantities[productId] || 1;
    
        row.innerHTML = `<td>${productName}</td><td>${originalPrice.toFixed(2)}</td><td><label for="quantity-${itemId}">Quantity:</label><input type="text" id="quantity-${itemId}" name="quantity[]" value="${quantity}" min="1" class="quantity"></td><td><button class="remove-item-button" data-item-id="${itemId}">Remove</button></td>`;
        row.dataset.productId = productId; // Add product ID to the dataset
        row.dataset.itemId = itemId; // Add item ID to the dataset
        row.dataset.itemPrice = originalPrice.toFixed(2);
        row.dataset.itemTotal = (originalPrice * quantity).toFixed(2); // Initialize item total
        orderItemsContainer.appendChild(row);
    
        const quantityInput = row.querySelector('input[name="quantity[]"]');
        quantityInput.addEventListener('input', function () {
            // Update the quantity in the productQuantities object
            productQuantities[productId] = parseInt(quantityInput.value, 10);
    
            // Update the item total when quantity changes
            updateItemTotal(row, originalPrice);
        });
    
        const removeButton = row.querySelector('.remove-item-button');
        removeButton.addEventListener('click', function () {
            row.remove();
    
            const correspondingAddButton = Array.from(addToOrderButtons).find(btn => btn.dataset.productId === productId);
            if (correspondingAddButton) {
                correspondingAddButton.disabled = false;
            }
    
            if (orderItemsContainer.children.length === 0) {
                customerInfoForm.style.display = 'none';
            }
    
            overallTotal -= parseFloat(row.dataset.itemTotal);
            overallTotalElement.textContent = overallTotal.toFixed(2);
    
            // Remove the quantity tracking for the removed product
            delete productQuantities[productId];
        });
    }
    

    
    function updateItemTotal(row, originalPrice) {
        const quantityInput = row.querySelector('input[name="quantity[]"]');
        const quantity = parseInt(quantityInput.value, 10);
        const itemTotal = originalPrice * quantity;

        row.dataset.itemTotal = itemTotal.toFixed(2);
        row.querySelector('td:nth-child(2)').textContent = originalPrice.toFixed(2);

        overallTotal = Array.from(orderItemsContainer.children).reduce((total, item) => total + parseFloat(item.dataset.itemTotal), 0);
        overallTotalElement.textContent = overallTotal.toFixed(2);
    }

    function showCustomerInfoForm() {
        customerInfoForm.style.display = 'block';
    }
});