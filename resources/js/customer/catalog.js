// Sidebar Filter
function OffcanvasControl(canvasId, openBtnId, closeBtnId) {
    const canvas = document.getElementById(canvasId);
    const backdrop = document.getElementById(canvasId + "Backdrop");
    const openBtn = document.getElementById(openBtnId);
    const closeBtn = document.getElementById(closeBtnId);

    if (!canvas || !backdrop || !openBtn || !closeBtn) {
        console.warn(
            "Elemen Offcanvas tidak ditemukan, fungsionalitas filter mungkin rusak."
        );
        return;
    }

    const openCanvas = () => {
        backdrop.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");

        backdrop.classList.add("z-[1100]");
        canvas.classList.add("z-[1110]");

        setTimeout(() => {
            backdrop.classList.add("opacity-100");
            canvas.classList.remove("translate-x-full");
        }, 10);

        canvas.setAttribute("aria-hidden", "false");
        canvas.focus();
    };

    const closeCanvas = () => {
        backdrop.classList.remove("opacity-100");
        canvas.classList.add("translate-x-full");
        document.body.classList.remove("overflow-hidden");

        setTimeout(() => {
            backdrop.classList.add("hidden");
        }, 300);

        canvas.setAttribute("aria-hidden", "true");
    };

    openBtn.addEventListener("click", openCanvas);
    closeBtn.addEventListener("click", closeCanvas);
    backdrop.addEventListener("click", closeCanvas);

    document.addEventListener("keydown", (e) => {
        if (
            e.key === "Escape" &&
            !canvas.classList.contains("translate-x-full")
        ) {
            closeCanvas();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi Sidebar Filter
    OffcanvasControl(
        "filterSidebar",
        "openFilterSidebarBtn",
        "closeFilterSidebarBtn"
    );

    // Posisi Scroll
    window.addEventListener("beforeunload", function () {
        localStorage.setItem("scrollPosition", window.scrollY);
    });

    const scrollPosition = localStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
        localStorage.removeItem("scrollPosition");
    }
});
