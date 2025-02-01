// Function to check if the device is mobile

window.addEventListener('scroll', function() {
    const header = document.getElementById('header');

    function isMobile() {
        return window.innerWidth <= 850;
    }

    if (!isMobile()) {
        const maxScroll = 400;
        const scrollY = window.scrollY;
        const opacity = Math.min(scrollY / maxScroll, 1);

        header.style.backgroundColor = `rgba(46, 139, 87, ${opacity})`;
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

document.querySelectorAll('.menu-link2').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior

        const targetId = this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

document.querySelectorAll('.menu-link2').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior

        const targetId = this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

window.onload = function() {
    if (window.innerWidth < 850) {
        document.getElementById("section-about").scrollIntoView({ behavior: "smooth" });
    } else {
        document.getElementById("section-awards").scrollIntoView({ behavior: "smooth" });
    }
};

window.onload = function() {
    // Get the hash from the URL (e.g., #section-about)
    const hash = window.location.hash;

    if (hash) {
        setTimeout(() => {
            document.querySelector(hash).scrollIntoView({ behavior: "smooth" });
        }, 100); // Slight delay to ensure the page is ready
    }
};


