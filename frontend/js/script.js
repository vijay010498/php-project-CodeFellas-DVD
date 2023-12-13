document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".slide");
    let slidesIndex = 0;
    let slideInterval;
    let isPaused = false;

    function displaySlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? "block" : "none";
        });
        updateDots(index);
    }

    function nextSlide() {
        if (!isPaused) {
            slidesIndex = (slidesIndex + 1) % slides.length;
            displaySlide(slidesIndex);
        }
    }

    function updateDots(index) {
        const dotsContainer = document.querySelector(".dots");
        dotsContainer.innerHTML = "";

        slides.forEach((_, i) => {
            const dot = document.createElement("span");
            dot.classList.add("dot");
            if (i === index) {
                dot.classList.add("activeDot");
            }
            dot.addEventListener("click", () => displaySlide(i));
            dotsContainer.appendChild(dot);
        });
    }

    setInterval(nextSlide, 2000);
});
