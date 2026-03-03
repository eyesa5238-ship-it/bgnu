const heroCarousel = document.querySelector('#heroCarousel');

const carousel = new bootstrap.Carousel(heroCarousel, {
    interval: 5000,
    pause: false,
    ride: 'carousel'
});
let images = [
    '/images/cmitip.png',
    '/images/banner2.png',
    '/images/banner3.png'
];
let currentIndex = 0;

function navigateBanner(direction) {
    if (direction === 'prev') {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
    } else if (direction === 'next') {
        currentIndex = (currentIndex + 1) % images.length;
    }
    document.querySelector('.banner-img').src = images[currentIndex];
}

function navigateBanner(direction) {
    if (direction === 'prev') {
        alert("Previous banner clicked!");
    } else if (direction === 'next') {
        alert("Next banner clicked!");
    }
}


document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    const speed = 200; // The lower the slower

    const animateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;

                // Determine increment step based on target size
                const inc = target / speed;

                if (count < target) {
                    // Check if it's a decimal number (like 67.7)
                    if (target % 1 !== 0) {
                        counter.innerText = (count + inc).toFixed(1);
                    } else {
                        counter.innerText = Math.ceil(count + inc);
                    }
                    setTimeout(updateCount, 20); // Run function every 20ms
                } else {
                    // Ensure it ends exactly on the target
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    // Intersection Observer: Only animate when user scrolls to section
    const section = document.querySelector('#statsSection');
    const observer = new IntersectionObserver((entries, observer) => {
        const [entry] = entries;
        if (entry.isIntersecting) {
            animateCounters();
            observer.unobserve(section); // Run only once
        }
    }, {
        root: null,
        threshold: 0.5, // Trigger when 50% of section is visible
    });

    observer.observe(section);
});