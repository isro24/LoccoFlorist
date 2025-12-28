// Modal Control
function ModalControl(modalId, openBtnId, closeBtnId) {
    const modal = document.getElementById(modalId);
    const backdrop = document.getElementById(modalId + "Backdrop");
    const openBtn = document.getElementById(openBtnId);
    const closeBtn = document.getElementById(closeBtnId);

    if (!modal || !backdrop || !openBtn || !closeBtn) return;

    const openModal = () => {
        backdrop.classList.remove("hidden");
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
        setTimeout(() => {
            backdrop.classList.add("opacity-100");
            modal.classList.add("opacity-100", "translate-y-0");
        }, 10);
        modal.setAttribute("aria-hidden", "false");
        modal.focus();
    };

    const closeModal = () => {
        backdrop.classList.remove("opacity-100");
        modal.classList.remove("opacity-100", "translate-y-0");
        document.body.style.overflow = "";
        setTimeout(() => {
            backdrop.classList.add("hidden");
            modal.classList.add("hidden");
        }, 300);
        modal.setAttribute("aria-hidden", "true");
    };

    openBtn.addEventListener("click", openModal);
    closeBtn.addEventListener("click", closeModal);
    backdrop.addEventListener("click", closeModal);

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            closeModal();
        }
    });
}

// Tab Control
function TabControl(tabsContainerId) {
    const tabsContainer = document.getElementById(tabsContainerId);
    if (!tabsContainer) return;

    const tabButtons = tabsContainer.querySelectorAll("button[data-tab-target]");
    const tabContents = document.querySelectorAll("[data-tab-content]");

    tabButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const targetId = button.dataset.tabTarget;
            const targetContent = document.getElementById(targetId);

            tabButtons.forEach((btn) => {
                btn.classList.remove("text-[#ff4b8b]", "border-[#ff4b8b]");
                btn.classList.add("text-gray-600", "border-transparent", "hover:border-gray-300");
            });

            tabContents.forEach((content) => content.classList.add("hidden"));

            button.classList.add("text-[#ff4b8b]", "border-[#ff4b8b]");
            button.classList.remove("text-gray-600", "border-transparent", "hover:border-gray-300");

            if (targetContent) targetContent.classList.remove("hidden");
        });
    });
}

// Interaksi Halaman Utama
document.addEventListener("DOMContentLoaded", () => {
    ModalControl("orderModal", "openOrderModalBtn", "closeOrderModalBtn");
    TabControl("productTabs");

    // Init Flatpickr
    if (typeof flatpickr !== "undefined") {
        flatpickr("#delivery_date", {
            dateFormat: "Y-m-d",
            minDate: "today",
            locale: "id",
            disableMobile: "true",
        });
        flatpickr("#delivery_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minTime: "08:00",
            maxTime: "22:00",
            disableMobile: "true",
        });
    }

    // Input Validasi WA
    const receiverInput = document.getElementById('receiver_phone_input');
    if (receiverInput) {
        receiverInput.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "");
            if (this.value.length > 15) this.value = this.value.slice(0, 15);
            if (!this.value.startsWith("0") || this.value.length < 10) {
                this.classList.add("border-red-500", "text-red-600");
            } else {
                this.classList.remove("border-red-500", "text-red-600");
            }
        });
    }

    // Logila Tampilan Dinamis 
    const categoryInput = document.getElementById("categoryType");
    const typeValue = categoryInput ? categoryInput.value.toLowerCase() : "";

    const isBanner = typeValue.includes("banner");
    const isPapan = typeValue.includes("papan");
    const isBunga = typeValue.includes("bunga");

    // Wrapper Elements
    const bannerFields = document.getElementById("bannerSpecificFields");
    const locationWrapper = document.getElementById("locationFieldsWrapper");
    const boardWrapper = document.getElementById("formatKalimatWrapper");
    const pickupMethodWrapper = document.getElementById("pickupMethodWrapper");
    
    // Receiver Elements
    const receiverNameContainer = document.getElementById("receiverNameContainer");
    const receiverPhoneContainer = document.getElementById("receiverPhoneContainer");

    // Inputs for Validation 
    const bannerOptionInput = document.getElementById("banner_option");
    const pickupMethodInput = document.getElementById("pickup_method");
    const locationInput = document.getElementById("receiver_location");
    const detailedInput = document.getElementById("detailedInput");
    const receiverNameInput = document.getElementById("receiver_name_input");
    const receiverPhoneInput = document.getElementById("receiver_phone_input");

    // Labels
    const labelDateAction = document.getElementById("labelDateAction");
    const labelTimeAction = document.getElementById("labelTimeAction");

    if (bannerFields) bannerFields.classList.add("hidden");
    if (locationWrapper) locationWrapper.classList.add("hidden");
    if (boardWrapper) boardWrapper.classList.add("hidden");
    if (pickupMethodWrapper) pickupMethodWrapper.classList.add("hidden");
    if (receiverNameContainer) receiverNameContainer.classList.add("hidden");
    if (receiverPhoneContainer) receiverPhoneContainer.classList.add("hidden");

    if (locationInput) locationInput.removeAttribute("required");
    if (detailedInput) detailedInput.removeAttribute("required");
    if (bannerOptionInput) bannerOptionInput.removeAttribute("required");
    if (pickupMethodInput) pickupMethodInput.removeAttribute("required");
    if (receiverNameInput) receiverNameInput.removeAttribute("required");
    if (receiverPhoneInput) receiverPhoneInput.removeAttribute("required");

    if (isPapan) {
        if (locationWrapper) locationWrapper.classList.remove("hidden");
        if (boardWrapper) boardWrapper.classList.remove("hidden");
        if (receiverNameContainer) receiverNameContainer.classList.remove("hidden");
        if (receiverPhoneContainer) receiverPhoneContainer.classList.remove("hidden");

        if (locationInput) locationInput.setAttribute("required", "true");
        if (detailedInput) detailedInput.setAttribute("required", "true");
        if (receiverNameInput) receiverNameInput.setAttribute("required", "true");
        if (receiverPhoneInput) receiverPhoneInput.setAttribute("required", "true");

        if (labelDateAction) labelDateAction.innerText = "Pengantaran";
        if (labelTimeAction) labelTimeAction.innerText = "Pengantaran";
    } 
    else if (isBanner) {
        if (bannerFields) {
            bannerFields.classList.remove("hidden");
            bannerFields.classList.add("grid");
        }
        if (pickupMethodWrapper) pickupMethodWrapper.classList.remove("hidden");

        if (bannerOptionInput) bannerOptionInput.setAttribute("required", "true");
        if (pickupMethodInput) pickupMethodInput.setAttribute("required", "true");

        if (labelDateAction) labelDateAction.innerText = "Pengambilan/Antar";
        if (labelTimeAction) labelTimeAction.innerText = "Pengambilan/Antar";
    } 

    else if (isBunga) {
        if (pickupMethodWrapper) pickupMethodWrapper.classList.remove("hidden");
        
        if (pickupMethodInput) pickupMethodInput.setAttribute("required", "true");

        if (labelDateAction) labelDateAction.innerText = "Pengambilan/Antar";
        if (labelTimeAction) labelTimeAction.innerText = "Pengambilan/Antar";
    }

    // Banner Price 
    const bannerOption = document.getElementById("banner_option");
    const paxWrapper = document.getElementById("paxWrapper");
    const paxSelect = document.getElementById("banner_pax_select");
    const priceWrapper = document.getElementById("priceEstimationWrapper");
    const displayPrice = document.getElementById("displayPrice");
    const inputEstimatedPrice = document.getElementById("inputEstimatedPrice");

    function calculateBannerPrice() {
        if (!isBanner) return;

        const selectedOption = bannerOption.options[bannerOption.selectedIndex];
        let basePrice = selectedOption ? parseInt(selectedOption.getAttribute("data-price")) : 0;
        if (isNaN(basePrice)) basePrice = 0;

        const needsPax = selectedOption ? selectedOption.getAttribute("data-needs-pax") === "true" : false;

        let extraPrice = 0;
        if (needsPax && paxSelect.value !== "") {
            extraPrice = parseInt(paxSelect.value);
        }
        if (isNaN(extraPrice)) extraPrice = 0;

        const finalPrice = basePrice + extraPrice;

        if (basePrice > 0) {
            priceWrapper.classList.remove("hidden");
            if (needsPax && paxSelect.value === "") {
                displayPrice.innerText = "Rp " + basePrice.toLocaleString("id-ID") + " (Pilih jumlah orang)";
                inputEstimatedPrice.value = basePrice;
            } else {
                displayPrice.innerText = "Rp " + finalPrice.toLocaleString("id-ID");
                inputEstimatedPrice.value = finalPrice;
            }
        } else {
            priceWrapper.classList.add("hidden");
            inputEstimatedPrice.value = "";
        }
    }

    if (bannerOption) {
        bannerOption.addEventListener("change", function () {
            const selectedOption = this.options[this.selectedIndex];
            const needsPax = selectedOption.getAttribute("data-needs-pax") === "true";

            if (needsPax) {
                paxWrapper.classList.remove("hidden");
                if (paxSelect) paxSelect.setAttribute("required", "true");
            } else {
                paxWrapper.classList.add("hidden");
                if (paxSelect) {
                    paxSelect.removeAttribute("required");
                    paxSelect.value = "";
                }
            }
            calculateBannerPrice();
        });
    }

    if (paxSelect) {
        paxSelect.addEventListener("change", function () {
            calculateBannerPrice();
        });
    }

    // Gosend Alert 
    const pickupMethod = document.getElementById("pickup_method");
    const gosendAlert = document.getElementById("gosendAlert");
    if (pickupMethod) {
        pickupMethod.addEventListener("change", function () {
            if (this.value === "gosend") gosendAlert.classList.remove("hidden");
            else gosendAlert.classList.add("hidden");
        });
    }

    // Image Slider Manual & Fullscreen
    window.changeImage = function (src) {
        const mainImage = document.getElementById("main-product-image");
        if (mainImage) {
            mainImage.style.opacity = 0.5;
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = 1;
                const thumbnails = document.querySelectorAll("#product-thumbnails button");
                thumbnails.forEach((btn) => {
                    btn.classList.remove("border-pinkButton");
                    btn.classList.add("border-transparent");
                    const img = btn.querySelector("img");
                    if (img && img.src === src) {
                        btn.classList.remove("border-transparent");
                        btn.classList.add("border-pinkButton");
                    }
                });
            }, 150);
        }
    };

    const fullscreenModal = document.getElementById('fullscreenModal');
    const fullscreenImage = document.getElementById('fullscreenImage');
    const mainProductImage = document.getElementById('main-product-image');

    window.openFullscreen = function() {
        if (!fullscreenModal || !fullscreenImage || !mainProductImage) return;
        fullscreenImage.src = mainProductImage.src;
        fullscreenModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            fullscreenModal.classList.remove('opacity-0');
            fullscreenImage.classList.remove('scale-95');
            fullscreenImage.classList.add('scale-100');
        }, 10);
    };

    window.closeFullscreen = function() {
        if (!fullscreenModal || !fullscreenImage) return;
        fullscreenModal.classList.add('opacity-0');
        fullscreenImage.classList.remove('scale-100');
        fullscreenImage.classList.add('scale-95');
        setTimeout(() => {
            fullscreenModal.classList.add('hidden');
            fullscreenImage.src = '';
            document.body.style.overflow = '';
        }, 300);
    };

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !fullscreenModal.classList.contains('hidden')) {
            closeFullscreen();
        }
    });
});