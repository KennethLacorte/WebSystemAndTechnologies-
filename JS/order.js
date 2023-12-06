 
    class OrderConfirmation {
        constructor() {
            this.setCurrentDate();
        }

        setCurrentDate() {
            var currentDate = new Date().toISOString().split('T')[0];
            this.orderDate = currentDate;
            document.getElementById('order-date').value = currentDate;
        }

        async confirmOrder() {
            var customerName = document.getElementById('customer-name').value;

            if (customerName.trim() === '') {
                this.showValidationError('Please enter customer name.');
                return;
            }

            var orderNumber = this.generateOrderNumber();
            var totalPrice = this.calculateTotalPrice();

            const result = await Swal.fire({
                title: 'Order Confirmation',
                html: `
                    <p><strong>Customer Name:</strong> ${customerName}</p>
                    <p><strong>Order Date:</strong> ${this.orderDate}</p>
                    <p><strong>Order Number:</strong> ${orderNumber}</p>
                    <p><strong>Total Price:</strong> $${totalPrice}</p>
                    <p>Order confirmed! Thank you for your purchase.</p>
                `,
                icon: 'success',
                confirmButtonText: 'OK'
            });

            if (result.isConfirmed) {
                document.getElementById('confirm-order-form').reset();

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
                        orderItems: this.getOrderItemsData(), // Add order items data
                    }),
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Server response:', data);
                } else {
                    console.error('Error confirming order on the server');
                }
            }
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
                const itemData = {
                    productID: item.dataset.productId, // Add the product ID here
                    itemID: item.dataset.itemId, // Add the item ID here
                    quantity: parseInt(item.querySelector('td:nth-child(3) input').value, 10),
                };

                orderItemsData.push(itemData);
            });

            return orderItemsData;
        }
    }

    const orderConfirmation = new OrderConfirmation();
    document.getElementById('submit-btn').addEventListener('click', () => orderConfirmation.confirmOrder());