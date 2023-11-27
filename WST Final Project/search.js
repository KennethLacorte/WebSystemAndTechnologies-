
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

