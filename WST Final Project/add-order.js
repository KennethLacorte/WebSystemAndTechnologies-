
            // JavaScript to handle the search functionality
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('searchInput');
                const rows = document.querySelectorAll('.content-table tbody tr');
                const tableTitles = document.querySelectorAll('.content-table thead');

                searchInput.addEventListener('input', function () {
                    const searchTerm = searchInput.value.toLowerCase();

                    rows.forEach(row => {
                        const productName = row.querySelector('td:first-child').textContent.toLowerCase();
                        const categoryName = row.closest('table').querySelector('.table-title').textContent.toLowerCase();

                        if (productName.includes(searchTerm) || categoryName.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Hide table headers if no matching results
                    tableTitles.forEach(title => {
                        const tableBodyRows = title.nextElementSibling.querySelectorAll('tr');
                        const visibleRows = Array.from(tableBodyRows).some(row => row.style.display !== 'none');

                        title.style.display = visibleRows ? '' : 'none';
                    });
                });

                // Prevent form submission on ENTER key press
                document.getElementById('add-order-form').addEventListener('submit', function (event) {
                    event.preventDefault();
                });
            });

    


       document.addEventListener('DOMContentLoaded', function () {
    const addToOrderButtons = document.querySelectorAll('.add-to-order-button');

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productName = button.dataset.productName;
            const productImg = button.dataset.productImg;
            const productPrice = button.dataset.productPrice;

            addToOrder(productName, productImg, productPrice);

            button.disabled = true;
            showCustomerInfoForm();
        });
    });
});

        // Function to add items to the order form
        function addToOrder(productName, productPrice) {
            const orderItemsContainer = document.getElementById('order-items');
            const row = document.createElement('tr');
            row.innerHTML = `<td>${productName}</td><td>${productPrice}</td><td><input type="number" name="quantity[]" value="1" min="1"></td>`;
            orderItemsContainer.appendChild(row);
        }
