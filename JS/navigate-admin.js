function navigateTo(page) {
    // Hide all content containers
    $('#dashboard-content, #add-products-content, #order-history-content, #view-account-content, #products-content').hide();

    // You can customize the URLs as needed
    switch (page) {
        case 'dashboard':
            $('#dashboard-content').show();
            break;
        case 'add-products':
            $('#add-products-content').show();
            break;
        case 'order-history':
            $('#order-history-content').show();
            break;
        case 'view-account':
            $('#view-account-content').show();
            break;
        case 'products':
            $('#products-content').show();
            break;
        case 'logout':
            // Handle logout logic if needed
            break;
        // Add cases for other pages
        default:
            break;
    }
}

// Updated part to prevent the default behavior of anchor links
$(document).ready(function () {
    $('.list-group-item').click(function (e) {
        e.preventDefault();

        // Get the href attribute of the clicked link
        var page = $(this).attr('href');

        // Remove the '#' from the href to get the page name
        page = page.substring(1);

        // Call the navigateTo function with the page name
        navigateTo(page);
    });
});