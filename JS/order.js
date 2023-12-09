class OrderConfirmation {
    constructor() {
        this.setCurrentDate();
        this.productQuantities = {}; // New property to store quantities for each product
    }

    setCurrentDate() {
        var currentDate = new Date().toISOString().split('T')[0];
        this.orderDate = currentDate;
        document.getElementById('order-date').value = currentDate;
    }

    displayOrderReceipt(orderNumber, customerName, orderDate, totalPrice) {
        const viewOrderContent = document.getElementById('vieworder-content');
    
        const receiptHTML = `<br><br><br>
        <div style="border: 1px solid #ccc; padding: 15px; margin: 10px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" class="order-card">
            <h2 style="color: #333;">Order Details</h2>
            <p><strong>Order Number:</strong> ${orderNumber}</p>
            <p><strong>Customer Name:</strong> ${customerName}</p>
            <p><strong>Order Date:</strong> ${orderDate}</p>
            <p><strong>Total Price:</strong> ₱ ${totalPrice}</p>
        </div>
    `;

    viewOrderContent.innerHTML = receiptHTML;
}

   async confirmOrder() {
    var customerName = document.getElementById('customer-name').value;

    if (customerName.trim() === '') {
        this.showValidationError('Please enter customer name.');
        return;
    }

    var orderNumber = this.generateOrderNumber();
    var totalPrice = this.calculateTotalPrice();

    // Display a confirmation modal using SweetAlert2
    const result = await Swal.fire({
        title: 'Order Placed Successfully',
        html: `
            <p>Your order has been placed! Thank you for your purchase.</p>
        `,
        icon: 'success',
        confirmButtonText: 'OK'
    });

    if (result.isConfirmed) {
        // Send the order details to the server for processing
        const response = await fetch('confirm_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                customerName,
                orderDate: this.orderDate,
                orderNumber,
                totalPrice,
                orderItems: this.getOrderItemsData(), // Include order items data
                productQuantities: this.productQuantities, // Include product quantities data
            }),
        });

        if (response.ok) {
            const data = await response.json();
            console.log('Server response:', data);

            // Reset and hide elements in the order-page
            this.resetOrderPage();

            // Add a delay before initiating a new order
            await new Promise(resolve => setTimeout(resolve, 1000)); // Adjust the delay as needed

            // Reset add order content
            const addOrderForm = document.getElementById('add-order-form');
            addOrderForm.reset();
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';

            // Display order receipt
            const orderItemsData = this.getOrderItemsData();
            this.displayOrderReceipt(orderNumber, customerName, this.orderDate, totalPrice, orderItemsData);
        } else {
            console.error('Error confirming order on the server');
        }
    }
}

    resetOrderPage() {
        const orderItems = document.getElementById('order-items');
        const customerInfoForm = document.getElementById('confirm-order-form');
        const overallTotalElement = document.getElementById('overall-total');
    
        orderItems.innerHTML = ''; // Clear order items
        customerInfoForm.style.display = 'none'; // Hide customer info form
    
        // Reset quantity and enable "Add to Order" buttons
        const addToOrderButtons = document.querySelectorAll('.add-to-order-button');
        addToOrderButtons.forEach(button => {
            button.disabled = false;
            const itemId = button.dataset.itemId;
            const quantityInput = document.querySelector(`#quantity-${itemId}`);
            quantityInput.value = 1; // Reset quantity to default (1)
            quantityInput.disabled = false; // Enable the quantity input
        });
    
        // Explicitly set overall total to zero in the frontend
        overallTotalElement.textContent = '0.00';
    
        // You may need additional logic here to reset the overall total in the database
        // This could involve making another API call to update the backend
    }
    
    generateOrderNumber() {
        return Math.floor(Math.random() * 1000000) + 1;
    }

    calculateTotalPrice() {
        let total = 0;
        const orderItems = document.querySelectorAll('#order-items tr');

        orderItems.forEach((item) => {
            const price = parseFloat(item.querySelector('td:nth-child(2)').innerText);
            const quantity = parseInt(item.querySelector('td:nth-child(3) input').value, 10);
            total += price * quantity;
        });

        return total.toFixed(2);
    }

    showValidationError(message) {
        Swal.fire({
            title: 'Validation Error',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }

    getOrderItemsData() {
        const orderItems = document.querySelectorAll('#order-items tr');
        const orderItemsData = [];

        orderItems.forEach((item) => {
            const productId = item.dataset.productId;
            const itemId = item.dataset.itemId;
            const quantity = parseInt(item.querySelector('td:nth-child(3) input').value, 10);

            const itemData = {
                productID: productId,
                itemID: itemId,
                quantity: quantity,
            };

            orderItemsData.push(itemData);
        });

        return orderItemsData;
    }

    addProductQuantity(productId, quantity) {
        // Add or update the quantity for the specified product
        this.productQuantities[productId] = quantity;
    }

    getProductQuantity(productId) {
        // Get the quantity for the specified product
        return this.productQuantities[productId] || 0;
    }

    // ... (other methods remain unchanged)
}

const orderConfirmation = new OrderConfirmation();
document.getElementById('submit-btn').addEventListener('click', () => orderConfirmation.confirmOrder());
