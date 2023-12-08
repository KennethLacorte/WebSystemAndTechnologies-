// Function to handle navbar button click
function onNavButtonClick(contentId, buttonId) {
  // Show the specified content and hide others
  showContent(contentId);

  // Remove the 'selected' class from all buttons
  var buttons = document.querySelectorAll(".nav-link");
  buttons.forEach(function (button) {
    button.classList.remove("selected");
  });

  // Add the 'selected' class to the clicked button
  var clickedButton = document.getElementById(buttonId);
  if (clickedButton) {
    clickedButton.classList.add("selected");
  }
}

// Function to show/hide content
function showContent(contentId) {
  // Hide all contents
  var contents = document.querySelectorAll(".content-section");
  contents.forEach(function (content) {
    content.style.display = "none";
  });

  // Show the specified content or default to main-content
  var selectedContent = document.getElementById(contentId) || document.getElementById("main-content");
  if (selectedContent) {
    selectedContent.style.display = "block";
  }
}
