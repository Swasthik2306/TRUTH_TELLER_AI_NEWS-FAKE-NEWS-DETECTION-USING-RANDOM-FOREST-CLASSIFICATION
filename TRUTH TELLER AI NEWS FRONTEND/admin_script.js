document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll("nav a");
    const currentPath = window.location.pathname;

    // Function to add the 'active' class to the current menu item
    function setActiveMenuItem() {
        for (const link of navLinks) {
            const linkPath = link.getAttribute("href");
            if (currentPath === linkPath) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        }
    }

    // Call the function initially
    setActiveMenuItem();
});
