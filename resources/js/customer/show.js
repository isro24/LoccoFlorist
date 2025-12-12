// Modal Control
function ModalControl(modalId, openBtnId, closeBtnId) {
    const modal = document.getElementById(modalId);
    const backdrop = document.getElementById(modalId + 'Backdrop');
    const openBtn = document.getElementById(openBtnId);
    const closeBtn = document.getElementById(closeBtnId);

    if (!modal || !backdrop || !openBtn || !closeBtn) return;

    const openModal = () => {
        backdrop.classList.remove('hidden');
        modal.classList.remove('hidden');

        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            backdrop.classList.add('opacity-100');
            modal.classList.add('opacity-100', 'translate-y-0');
        }, 10);

        modal.setAttribute('aria-hidden', 'false');
        modal.focus();

        initAutocomplete();
    };

    const closeModal = () => {
        backdrop.classList.remove('opacity-100');
        modal.classList.remove('opacity-100', 'translate-y-0');
        
        document.body.style.overflow = '';

        setTimeout(() => {
            backdrop.classList.add('hidden');
            modal.classList.add('hidden');
        }, 300);

        modal.setAttribute('aria-hidden', 'true');
    };

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}

// Tab Control
function TabControl(tabsContainerId) {
    const tabsContainer = document.getElementById(tabsContainerId);
    if (!tabsContainer) return;

    const tabButtons = tabsContainer.querySelectorAll('button[data-tab-target]');
    const tabContents = document.querySelectorAll('[data-tab-content]');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.tabTarget;
            const targetContent = document.getElementById(targetId);

            tabButtons.forEach(btn => {
                btn.classList.remove('text-[#ff4b8b]', 'border-[#ff4b8b]');
                btn.classList.add('text-gray-600', 'border-transparent', 'hover:border-gray-300');
            });

            tabContents.forEach(content => content.classList.add('hidden'));

            button.classList.add('text-[#ff4b8b]', 'border-[#ff4b8b]');
            button.classList.remove('text-gray-600', 'border-transparent', 'hover:border-gray-300');

            if (targetContent) targetContent.classList.remove('hidden');
        });
    });
}

// Google Maps + Autocomplete
let map, marker, geocoder, distanceService;
const tokoPos = { lat: -7.801194, lng: 110.364917 }; 

window.initMap = function() {
    const defaultPos = { lat: -7.7956, lng: 110.3695 };
    const mapElement = document.getElementById("map");
    if (!mapElement) return;

    map = new google.maps.Map(mapElement, {
        center: defaultPos,
        zoom: 13,
        disableDefaultUI: true,
        zoomControl: true
    });

    geocoder = new google.maps.Geocoder();
    distanceService = new google.maps.DistanceMatrixService();

    marker = new google.maps.Marker({
        position: defaultPos,
        map: map,
        draggable: true
    });

    marker.addListener('dragend', () => {
        const pos = marker.getPosition();
        updateLocationInput(pos.lat(), pos.lng());
    });

    map.addListener('click', (e) => {
        marker.setPosition(e.latLng);
        updateLocationInput(e.latLng.lat(), e.latLng.lng());
    });

    // Cek geolocation user
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userPos = { lat: position.coords.latitude, lng: position.coords.longitude };
                map.setCenter(userPos);
                marker.setPosition(userPos);
                updateLocationInput(userPos.lat, userPos.lng);
            },
            () => updateLocationInput(defaultPos.lat, defaultPos.lng)
        );
    } else {
        updateLocationInput(defaultPos.lat, defaultPos.lng);
    }
};

// Inisialisasi Autocomplete 
function initAutocomplete() {
    const searchInput = document.getElementById('map-search-input');
    if (!searchInput) return;

    if (searchInput.autocompleteInstance) {
        google.maps.event.clearInstanceListeners(searchInput.autocompleteInstance);
    }

    const autocomplete = new google.maps.places.Autocomplete(searchInput);
    searchInput.autocompleteInstance = autocomplete;
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        if (!place.geometry || !place.geometry.location) return;
        map.setCenter(place.geometry.location);
        map.setZoom(17);
        marker.setPosition(place.geometry.location);
        updateLocationInput(place.geometry.location.lat(), place.geometry.location.lng());
    });

    const style = document.createElement('style');
    style.innerHTML = `.pac-container { z-index: 2000 !important; }`;
    document.head.appendChild(style);
}

// Update input lokasi + jarak
function updateLocationInput(lat, lng) {
    const input = document.getElementById('receiver_location');
    if (!input) return;
    input.value = "Memuat alamat...";

    geocoder.geocode({ location: { lat, lng } }, (results, status) => {
        input.value = (status === "OK" && results[0]) ? results[0].formatted_address : `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
    });

    distanceService.getDistanceMatrix({
        origins: [tokoPos],
        destinations: [{ lat, lng }],
        travelMode: google.maps.TravelMode.DRIVING,
    }, (response, status) => {
        if (status === "OK" && response.rows[0].elements[0].status === "OK") {
            const distanceText = response.rows[0].elements[0].distance.text;
            const durationText = response.rows[0].elements[0].duration.text;
            let infoBox = document.getElementById('distance-info');
            if (!infoBox) {
                infoBox = document.createElement('div');
                infoBox.id = 'distance-info';
                infoBox.className = 'text-gray-500 mt-2 text-sm';
                input.after(infoBox);
            }
            infoBox.innerHTML = `<i class="bi bi-truck text-red-600"></i> Jarak dari toko: <b>${distanceText}</b> (± ${durationText})`;
        }
    });
}

// Interaksi Halaman
document.addEventListener('DOMContentLoaded', () => {

    // Modal
    ModalControl('orderModal', 'openOrderModalBtn', 'closeOrderModalBtn');

    // Tabs
    TabControl('productTabs');

    // Opsi Produk (Sewa papan / Bunga / Banner)
    const boardTypeWrapper = document.getElementById('boardTypeWrapper');
    const formatWrapper = document.getElementById('formatKalimatWrapper');

    const typeInput = document.querySelector('input[name="type"]');
    const productType = typeInput ? typeInput.value.toLowerCase() : '';

    const isPapan = productType.includes('papan');

    if (isPapan) {
        if (boardTypeWrapper) {
            boardTypeWrapper.classList.remove('hidden');
            const input = boardTypeWrapper.querySelector('input');
            if (input) input.disabled = false;
        }

        if (formatWrapper) {
            formatWrapper.classList.remove('hidden');
            formatWrapper.querySelectorAll('input, textarea')
                .forEach(el => el.disabled = false);
        }
    }

    // Validasi Nomor Telepon
    const receiverInput = document.getElementById('receiver_phone');
    if (receiverInput) {
        const orderForm = receiverInput.closest('form');
        const invalidClasses = ['border-red-500','text-red-600','focus:border-red-500','focus:ring-red-500','focus:ring-2'];
        const defaultClasses = ['border-none','focus:shadow-[0_0_0_3px_rgba(255,128,171,0.3)]','focus:ring-0'];

        receiverInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 15) this.value = this.value.slice(0,15);

            if (!this.value.startsWith('0') || this.value.length < 10) {
                this.classList.remove(...defaultClasses);
                this.classList.add(...invalidClasses);
            } else {
                this.classList.remove(...invalidClasses);
                this.classList.add(...defaultClasses);
            }
        });

        orderForm.addEventListener('submit', function(e) {
            if (!receiverInput.value.startsWith('0') || receiverInput.value.length < 10) {
                e.preventDefault();
                receiverInput.classList.remove(...defaultClasses);
                receiverInput.classList.add(...invalidClasses);
                receiverInput.focus();
            }
        });
    }

    // Quantity Selector
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const quantityInput = document.getElementById('quantityInput');

    if (decreaseBtn && increaseBtn && quantityInput) {
        increaseBtn.addEventListener('click', () => {
            let current = parseInt(quantityInput.value) || 1;
            quantityInput.value = current + 1;
        });

        decreaseBtn.addEventListener('click', () => {
            let current = parseInt(quantityInput.value) || 1;
            if (current > 1) quantityInput.value = current - 1;
        });

        quantityInput.addEventListener('input', () => {
            let val = parseInt(quantityInput.value);
            if (isNaN(val) || val < 1) quantityInput.value = 1;
        });
    }

    // Zoom Efek Gambar Produk
    document.querySelectorAll('.zoom-container').forEach(container => {
        const img = container.querySelector('.zoom-image');
        if (!img) return;

        let targetX = 50, targetY = 50;
        let currentX = 50, currentY = 50;

        container.addEventListener('mousemove', e => {
            const rect = container.getBoundingClientRect();
            targetX = ((e.clientX - rect.left) / rect.width) * 100;
            targetY = ((e.clientY - rect.top) / rect.height) * 100;
        });

        container.addEventListener('mouseleave', () => {
            targetX = 50;
            targetY = 50;
        });

        function animate() {
            currentX += (targetX - currentX) * 0.1;
            currentY += (targetY - currentY) * 0.1;
            img.style.transformOrigin = `${currentX}% ${currentY}%`;
            requestAnimationFrame(animate);
        }

        animate();
    });

    // Datepicker
    flatpickr("#delivery_date", {
        dateFormat: "Y-m-d",
        minDate: "today",
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
            },
            months: {
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
            }
        }
    });

    // Timepicker
    flatpickr("#delivery_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minTime: "08:00",
        maxTime: "20:00"
    });

});
