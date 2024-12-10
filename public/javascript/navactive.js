const activePage = window.location.pathname; // Get current page path
const navLinks = document.querySelectorAll('nav a'); // Select all <a> elements in the nav

navLinks.forEach(element => {
    // Compare the pathname of each nav link's href with the current page's pathname
    if (element.pathname === activePage) {
        element.classList.add('active'); // Add 'active' class to the matching link
    }
});
