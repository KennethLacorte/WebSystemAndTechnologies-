function showContent(contentId) {
    // Hide all content sections
    var contentSections = document.querySelectorAll('.container-lg');
    contentSections.forEach(function(section) {
        section.style.display = 'none';
    });

    // Show or hide the selected content section based on its current state
    var selectedContent = document.getElementById(contentId + '-content');
    if (selectedContent) {
        var displayStyle = selectedContent.style.display;
        selectedContent.style.display = displayStyle === 'none' ? 'block' : 'none';
    }
}