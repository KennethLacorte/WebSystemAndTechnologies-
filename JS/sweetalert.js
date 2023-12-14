// Event listener for button click
document.getElementById('submit-btn').addEventListener('click', function () {
    showFloatingForm();
});

function showFloatingForm() {
    Swal.fire({
        title: "Order Confirmation",
        html: `
            <form id="confirm-order-form">
                <label for="customer-name">Customer Name:</label>
                <input type="text" id="customer-name" name="customer-name" required>
                <br>
                <label for="customer-email">Customer Email:</label>
                <input type="email" id="customer-email" name="customer-email" required>
                <br>
            </form>
        `,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, confirm!",
    }).then(function (result) {
        if (result.isConfirmed) {
            console.log('Order confirmed!');
        } else {
            console.log('Order not confirmed.');
        }
    });
}
