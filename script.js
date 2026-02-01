// ============================================
// METSAKOHIN OÜ - MODERN JAVASCRIPT
// ============================================

// Helper function to check if device is mobile
function isMobile() {
    return window.innerWidth <= 850;
}

// ============================================
// HEADER SCROLL BEHAVIOR
// ============================================
let lastScrollTop = 0;
const header = document.getElementById('header');

window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Add scrolled class for styling
    if (scrollTop > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
    
    // Update scroll progress indicator
    const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollProgress = (scrollTop / windowHeight) * 100;
    header.style.setProperty('--scroll-progress', `${scrollProgress}%`);
    
    lastScrollTop = scrollTop;
});

// ============================================
// MOBILE MENU TOGGLE
// ============================================
document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById("menu-toggle");
    const navbar = document.querySelector(".navbar");
    const menuLinks = document.querySelectorAll(".navbar a");

    if (menuToggle && navbar) {
        // Toggle menu
        menuToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            menuToggle.classList.toggle("active");
            navbar.classList.toggle("active");
            
            // Prevent body scroll when menu is open
            if (navbar.classList.contains("active")) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        // Close menu when clicking a link
        menuLinks.forEach(link => {
            link.addEventListener("click", () => {
                menuToggle.classList.remove("active");
                navbar.classList.remove("active");
                document.body.style.overflow = '';
            });
        });

        // Close menu when clicking outside
        document.addEventListener("click", (e) => {
            if (navbar.classList.contains("active") &&
                !navbar.contains(e.target) &&
                !menuToggle.contains(e.target)) {
                menuToggle.classList.remove("active");
                navbar.classList.remove("active");
                document.body.style.overflow = '';
            }
        });

        // Close menu on escape key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && navbar.classList.contains("active")) {
                menuToggle.classList.remove("active");
                navbar.classList.remove("active");
                document.body.style.overflow = '';
            }
        });
    }

});

// ============================================
// SMOOTH SCROLL FOR ANCHOR LINKS
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const headerHeight = header ? header.offsetHeight : 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});

