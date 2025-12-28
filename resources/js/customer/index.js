document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".myHeroSwiper", {
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        effect: "fade",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
});
