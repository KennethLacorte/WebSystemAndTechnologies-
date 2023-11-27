function loadPage(pageId) {
    // Get the content sections
    var contentSections = document.getElementsByClassName('content-section');

    // Hide all content sections
    for (var i = 0; i < contentSections.length; i++) {
        contentSections[i].style.display = 'none';
    }

    // Show the selected content section
    var selectedSection = document.getElementById(pageId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}
