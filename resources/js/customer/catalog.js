document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener("beforeunload", function () {
        localStorage.setItem("scrollPosition", window.scrollY);
    });

    const scrollPosition = localStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
        localStorage.removeItem("scrollPosition");
    }
});