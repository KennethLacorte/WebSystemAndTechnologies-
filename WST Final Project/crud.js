
// Function to handle creating an order
function createOrder(productName, quantity, price) {
    $.ajax({
        type: "POST",
        url: "create.php",
        data: {
            product_name: productName,
            quantity: quantity,
            price: price
        },
        success: function (response) {
            console.log(response);
            // Handle success, e.g., show a success message
        },
        error: function (error) {
            console.error(error);
            // Handle error, e.g., show an error message
        }
    });
}

// Function to handle reading orders
function readOrders() {
    $.ajax({
        type: "GET",
        url: "read.php",
        success: function (response) {
            console.log(response);
            // Handle success, e.g., update the UI with fetched orders
        },
        error: function (error) {
            console.error(error);
            // Handle error, e.g., show an error message
        }
    });
}

// Function to handle updating the quantity of an order
function updateQuantity(orderId, newQuantity) {
    $.ajax({
        type: "POST",
        url: "update.php",
        data: {
            order_id: orderId,
            new_quantity: newQuantity
        },
        success: function (response) {
            console.log(response);
            // Handle success, e.g., show a success message
        },
        error: function (error) {
            console.error(error);
            // Handle error, e.g., show an error message
        }
    });
}

// Function to handle deleting an order
function deleteOrder(orderId) {
    $.ajax({
        type: "POST",
        url: "delete.php",
        data: {
            order_id: orderId
        },
        success: function (response) {
            console.log(response);
            // Handle success, e.g., show a success message
        },
        error: function (error) {
            console.error(error);
            // Handle error, e.g., show an error message
        }
    });
}
