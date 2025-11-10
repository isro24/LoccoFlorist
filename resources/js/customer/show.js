// Maps and Location Selection
const tokoPos = { lat: -7.801194, lng: 110.364917 };
let map, marker, geocoder, distanceService;

window.initMap = function() {
    const defaultPos = { lat: -7.7956, lng: 110.3695 }; 

    map = new google.maps.Map(document.getElementById("map"), {
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

    const searchInput = document.getElementById('map-search-input');
    const autocomplete = new google.maps.places.Autocomplete(searchInput);
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        if (!place.geometry || !place.geometry.location) return;
        map.setCenter(place.geometry.location);
        map.setZoom(17);
        marker.setPosition(place.geometry.location);
        updateLocationInput(place.geometry.location.lat(), place.geometry.location.lng());
    });

    marker.addListener('dragend', () => {
        const pos = marker.getPosition();
        updateLocationInput(pos.lat(), pos.lng());
    });

    map.addListener('click', (e) => {
        marker.setPosition(e.latLng);
        updateLocationInput(e.latLng.lat(), e.latLng.lng());
    });

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
}

function updateLocationInput(lat, lng) {
    const input = document.getElementById('receiver_location');
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
                infoBox.className = 'text-muted mt-2';
                document.getElementById('receiver_location').after(infoBox);
            }
            infoBox.innerHTML = `<i class="bi bi-truck text-danger"></i> Jarak dari toko: <b>${distanceText}</b> (± ${durationText})`;
        }
    });
}

// Product Detail Page Interactions
document.addEventListener('DOMContentLoaded', () => {
    const typeSelect = document.getElementById('productTypeSelect');
    const boardTypeWrapper = document.getElementById('boardTypeWrapper');
    const formatWrapper = document.getElementById('formatKalimatWrapper');

    typeSelect.addEventListener('change', function() {
        if (this.value === 'Sewa papan') {
            boardTypeWrapper.style.display = 'block';
            boardTypeWrapper.querySelector('input').disabled = false;

            formatWrapper.style.display = 'block';
            formatWrapper.querySelectorAll('input, textarea').forEach(el => el.disabled = false);
        } else {
            boardTypeWrapper.style.display = 'none';
            boardTypeWrapper.querySelector('input').disabled = true;

            formatWrapper.style.display = 'none';
            formatWrapper.querySelectorAll('input, textarea').forEach(el => el.disabled = true);
        }
    });

     document.querySelectorAll('#faqAccordion .accordion-collapse').forEach(collapse => {
        collapse.addEventListener('show.bs.collapse', () => {
            console.log('Collapse dibuka:', collapse.id);
        });
        collapse.addEventListener('shown.bs.collapse', () => {
            console.log('Collapse selesai dibuka:', collapse.id);
        });
        collapse.addEventListener('hide.bs.collapse', () => {
            console.log('Collapse ditutup:', collapse.id);
        });
        collapse.addEventListener('hidden.bs.collapse', () => {
            console.log('Collapse selesai ditutup:', collapse.id);
        });
    });

    // Phone Number Input Restriction
    const receiverInput = document.getElementById('receiver_phone');
    const orderForm = receiverInput.closest('form');

    receiverInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 15) this.value = this.value.slice(0, 15);

        if (!this.value.startsWith('0') || this.value.length < 10) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });

    orderForm.addEventListener('submit', function(e) {
        if (!receiverInput.value.startsWith('0') || receiverInput.value.length < 10) {
            e.preventDefault();
            receiverInput.classList.add('is-invalid');
            receiverInput.focus();
        }
    });

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
            if (current > 1) {
                quantityInput.value = current - 1;
            }
        });

        quantityInput.addEventListener('input', () => {
            let val = parseInt(quantityInput.value);
            if (isNaN(val) || val < 1) {
                quantityInput.value = 1;
            }
        });
    }
});

// Image Zoom Effect
document.querySelectorAll('.zoom-container').forEach(container => {
    const img = container.querySelector('.zoom-image');
    let targetX = 50, targetY = 50; 
    let currentX = 50, currentY = 50; 
    let isHovering = false;

    container.addEventListener('mousemove', e => {
        const rect = container.getBoundingClientRect();
        targetX = ((e.clientX - rect.left) / rect.width) * 100;
        targetY = ((e.clientY - rect.top) / rect.height) * 100;
        isHovering = true;
    });

    container.addEventListener('mouseleave', () => {
        targetX = 50;
        targetY = 50;
        isHovering = false;
    });

    function animate() {
        currentX += (targetX - currentX) * 0.1;
        currentY += (targetY - currentY) * 0.1;
        img.style.transformOrigin = `${currentX}% ${currentY}%`;
        requestAnimationFrame(animate);
    }

    animate();
});

// Number Input Validation
document.addEventListener('DOMContentLoaded', () => {
  const phoneInput = document.getElementById('receiver_phone');

  phoneInput.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
  });
});



