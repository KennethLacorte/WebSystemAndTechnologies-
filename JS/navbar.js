let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('.collapse .navbar-nav .nav-link a');

// Function to remove 'active' class from all links
function removeActiveClass() {
    navLinks.forEach(link => {
        link.classList.remove('active');
    });
}

// Check if the page is reloaded (not from a hash change or back/forward navigation)
if (performance.navigation.type === 1) {
    // Page is reloaded, scroll to the top
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    // Add 'active' class to the first link on page load
    if (navLinks.length > 0) {
        navLinks[0].classList.add('active');
    }
}

window.onscroll = () => {
    let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

    sections.forEach(section => {
        let top = section.offsetTop - 150;
        let bottom = top + section.offsetHeight;
        let id = section.getAttribute('id');

        if (scrollPosition >= top && scrollPosition < bottom) {
            // Remove 'active' class from all links
            removeActiveClass();

            // Add 'active' class to the corresponding link
            let activeLink = document.querySelector('.collapse .navbar-nav .nav-link[href="#' + id + '"]');
            if (activeLink) {
                activeLink.classList.add('active');
            }
        }
    });
};



function handleHoverAndClick(link) {
    link.addEventListener('mouseenter', () => {
        if (!link.classList.contains('active')) {
            link.classList.add('hover');
        }
    });

    link.addEventListener('mouseleave', () => {
        if (!link.classList.contains('active')) {
            link.classList.remove('hover');
        }
    });

    link.addEventListener('click', () => {
        navLinks.forEach(otherLink => {
            if (otherLink !== link) {
                otherLink.classList.remove('hover', 'active');
            }
        });

        link.classList.add('active');
    });
}

navLinks.forEach(link => {
    handleHoverAndClick(link);
});
