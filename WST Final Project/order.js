document.addEventListener('DOMContentLoaded', function () {
    const addToOrderButtons = document.querySelectorAll('.add-to-order-button');
    const orderItemsContainer = document.getElementById('order-items');
    const customerInfoForm = document.getElementById('confirm-order-form');
    const dateContainer = document.getElementById('date-container');
    const dateInput = document.getElementById('date-input');

    // Hide the customer information form, date container, and date input initially
    customerInfoForm.style.display = 'none';
    dateContainer.style.display = 'none';
    dateInput.style.display = 'none';

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Check if the button is not disabled
            if (!button.disabled) {
                const productName = button.dataset.productName;
                const productPrice = button.dataset.productPrice;

                // Call a function to add the item to the order form
                addToOrder(productName, productPrice);

                // Disable the button to prevent further clicks
                button.disabled = true;

                // Show customer information fields and submit button
                showCustomerInfoForm();
            }
        });
    });

    // Function to add items to the order form
    function addToOrder(productName, productPrice) {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${productName}</td><td>${productPrice}</td><td style="text-align: center; width: 50px;"><input type="number" name="quantity[]" value="1" min="1" style="width: 100%;"></td><td><button class="remove-item-button">Remove</button></td>`;
        orderItemsContainer.appendChild(row);

        // Add event listener to the newly added remove button
        const removeButton = row.querySelector('.remove-item-button');
        removeButton.addEventListener('click', function () {
            // Remove the item from the order
            row.remove();

            // Enable the corresponding "Add to Order" button
            const correspondingAddButton = Array.from(addToOrderButtons).find(btn => btn.dataset.productName === productName);
            if (correspondingAddButton) {
                correspondingAddButton.disabled = false;
            }

            // Check if there are no items in the order, then hide the customer information form and date container
            if (orderItemsContainer.children.length === 0) {
                customerInfoForm.style.display = 'none';
                dateContainer.style.display = 'none';
                dateInput.style.display = 'none';
            }
        });
    }

    // Function to show customer information fields and submit button
    function showCustomerInfoForm() {
        customerInfoForm.style.display = 'block';
        dateContainer.style.display = 'block';
        dateInput.style.display = 'block';
    }
});
