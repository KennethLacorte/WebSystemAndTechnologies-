
document.addEventListener('DOMContentLoaded', function() {
    const addToOrderButtons = document.querySelectorAll('.add-to-order-button');
    const orderItemsContainer = document.getElementById('order-items');
    const customerInfoForm = document.getElementById('confirm-order-form');
    const overallTotalElement = document.getElementById('overall-total');

    customerInfoForm.style.display = 'none';
    let overallTotal = 0.00;

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!button.disabled) {
                const productName = button.dataset.productName;
                const productPrice = parseFloat(button.dataset.productPrice);

                addToOrder(productName, productPrice);

                button.disabled = true;
                showCustomerInfoForm();
            }
        });
    });

    function addToOrder(productName, productPrice) {
        const row = document.createElement('tr');
        const originalPrice = productPrice;

        row.innerHTML = `<td>${productName}</td><td>${originalPrice.toFixed(2)}</td><td><input type="number" name="quantity[]" value="1" min="1"></td><td><button class="remove-item-button">Remove</button></td>`;
        orderItemsContainer.appendChild(row);

        const quantityInput = row.querySelector('input[name="quantity[]"]');
        quantityInput.addEventListener('input', function() {
            updateItemTotal(row, originalPrice);
        });

        updateItemTotal(row, originalPrice);

        const removeButton = row.querySelector('.remove-item-button');
        removeButton.addEventListener('click', function() {
            row.remove();

            const correspondingAddButton = Array.from(addToOrderButtons).find(btn => btn.dataset.productName === productName);
            if (correspondingAddButton) {
                correspondingAddButton.disabled = false;
            }

            if (orderItemsContainer.children.length === 0) {
                customerInfoForm.style.display = 'none';
            }

            overallTotal -= parseFloat(row.dataset.itemTotal);
            overallTotalElement.textContent = overallTotal.toFixed(2);
        });
    }

    function updateItemTotal(row, originalPrice) {
        const quantityInput = row.querySelector('input[name="quantity[]"]');
        const quantity = parseInt(quantityInput.value, 10);
        const itemTotal = originalPrice * quantity;

        row.dataset.itemTotal = itemTotal;
        row.querySelector('td:nth-child(2)').textContent = originalPrice.toFixed(2);

        overallTotal = Array.from(orderItemsContainer.children).reduce((total, item) => total + parseFloat(item.dataset.itemTotal), 0);
        overallTotalElement.textContent = overallTotal.toFixed(2);
    }

    function showCustomerInfoForm() {
        customerInfoForm.style.display = 'block';
    }
});
