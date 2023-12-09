// receipt.js

// Import OrderConfirmation class from order.js
import { OrderConfirmation } from './order.js';

function confirmOrder() {
    // Get customer name and order date
    var customerName = document.getElementById("customer-name").value;
    var orderDate = document.getElementById("order-date").value;

    // Instantiate OrderConfirmation to access generateOrderNumber()
    var orderConfirmation = new OrderConfirmation();

    // Use the order number generated in order.js
    var orderNumber = orderConfirmation.generateOrderNumber();

    // Get the order items
    var orderItemsContainer = document.getElementById("order-items");

    // Create an array to store product details
    var productDetails = [];

    // Loop through each row in the order items table
    var rows = orderItemsContainer.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");

        // Extract relevant product details from each row
        var product = {
            name: cells[0].innerText.trim(),
            price: cells[1].innerText.trim(),
            quantity: cells[2].querySelector('input.quantity').value.trim()
        };

        // Add the product details to the array
        productDetails.push(product);
    }

    // Display order details in the "View Order" section
    var orderDetailsContainer = document.getElementById("order-details");

    // Generate HTML for the product details
    var productDetailsHTML = productDetails.map(product => {
        return `
            <tr>
                <td>${product.name}</td>
                <td>${product.price}</td>
                <td>${product.quantity}</td>
            </tr>
        `;
    }).join('');

    // Calculate overall total based on product prices and quantities
    var overallTotal = calculateOverallTotal(productDetails);

    // Display order details in the "View Order" section
    orderDetailsContainer.innerHTML = `
        <div class="order-card">
        <br> <br>
        <h2>Order Details:</h2>
        <p><strong>Order Number:</strong> ${orderNumber}</p>
        <p><strong>Customer Name:</strong> ${customerName}</p>
        <p><strong>Order Date:</strong> ${orderDate}</p>
        <p><strong>Overall Total:</strong> ${overallTotal}</p>
            </div>
    `;

    // Optionally, you can clear the form or perform other actions here

    // Scroll to the "View Order" section
    document.getElementById("vieworder-content").scrollIntoView();
}

// Function to calculate overall total based on product details
function calculateOverallTotal(productDetails) {
    var overallTotal = 0.00;

    // Iterate through product details and calculate the total
    for (var i = 0; i < productDetails.length; i++) {
        var price = parseFloat(productDetails[i].price);
        var quantity = parseInt(productDetails[i].quantity) || 0; // Use 0 if quantity is not a valid number
        overallTotal += price * quantity;
    }

    return overallTotal.toFixed(2);
}

// ... (ibang kodigo)
