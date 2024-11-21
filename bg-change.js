document.addEventListener("DOMContentLoaded", () => {
    const openingDiv = document.querySelector(".opening");

    if (openingDiv) {
        const bgImages = ["styles/logs-bg.jpg", "styles/background.jpg", "styles/form-bg-new.jpg"];
        let index = 0;

        const changeBackground = () => {
            openingDiv.style.backgroundImage = `url(${bgImages[index]})`;
            index = (index + 1) % bgImages.length;
        };

        // Set the initial background
        changeBackground();

        // Change the background every 7 seconds
        setInterval(changeBackground, 7000);
    } else {
        console.error("Element with class 'opening' not found in the DOM.");
    }
});