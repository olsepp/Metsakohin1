// Function to check if the device is mobile

window.addEventListener('scroll', function() {
    const header = document.getElementById('header');

    function isMobile() {
        return window.innerWidth <= 850; // Adjust this threshold if necessary
    }

    if (!isMobile()) {
        const maxScroll = 400; // Adjust this value based on when you want the color to be fully applied
        const scrollY = window.scrollY;
        const opacity = Math.min(scrollY / maxScroll, 1); // Calculate opacity based on scroll position

        header.style.backgroundColor = `rgba(46, 139, 87, ${opacity})`; // Adjust the color and opacity
    }
    else {
        header.style.backgroundColor = `rgba(46, 139, 87, 1)`;
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const logo = document.getElementById('logo');
    const initialLogoHeight = 6; // Initial max height in vw
    const logoHeightOnMobile = 3;
    const finalLogoHeight = 3; // Final max height in vw
    const scrollThreshold = 350; // Scroll position for reaching final size

    // Helper function to check if the device is mobile
    function isMobile() {
        return window.innerWidth <= 850; // Adjust the mobile breakpoint as needed
    }

    // If it's not a mobile device, apply scroll resizing logic
    if (!isMobile()) {
        window.addEventListener('scroll', function () {
            const scrollY = window.scrollY;

            // Calculate the new max-height based on scroll position
            const newHeight = Math.max(finalLogoHeight, initialLogoHeight - ((scrollY / scrollThreshold) * (initialLogoHeight - finalLogoHeight)));
            logo.style.maxHeight = `${newHeight}vw`;
        });
    } else {
        // On mobile, keep the logo size fixed and do nothing
        logo.style.maxHeight = `${logoHeightOnMobile}rem`;  // Keep the original size
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById("menu-toggle");
    const navbar = document.querySelector(".navbar");
    const menuLinks = document.querySelectorAll(".navbar a");

    menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navbar.classList.toggle("active");
    });
    menuLinks.forEach(link => {
        link.addEventListener("click", () => {
            menuToggle.classList.remove("active");
            navbar.classList.remove("active");
        });
    });
});

