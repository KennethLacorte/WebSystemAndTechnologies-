 // Event listener for button click
 document.getElementById('Submit').addEventListener('click', function () {
    showFloatingForm();
});

function showFloatingForm() {
    // Customize the appearance and behavior of the SweetAlert2 modal
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
            // If the user clicks "Yes, confirm!", you can proceed with further actions
            console.log('Order confirmed!');
        } else {
            // If the user clicks "Cancel" or closes the SweetAlert, you can handle it here
            console.log('Order not confirmed.');
        }
    });
}