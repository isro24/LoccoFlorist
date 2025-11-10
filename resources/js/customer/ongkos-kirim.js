let map, marker, geocoder, distanceService, autocomplete;
const tokoPos = { lat: -7.801194, lng: 110.364917 };

window.initMap = function() {
    const defaultPos = tokoPos;

    map = new google.maps.Map(document.getElementById("map"), {
        center: defaultPos,
        zoom: 14,
        styles: [
            { featureType: "landscape", elementType: "geometry", stylers: [{ color: "#f8f0f5" }] },
            { featureType: "road", elementType: "geometry", stylers: [{ color: "#e3e3e3" }] },
            { featureType: "water", elementType: "geometry", stylers: [{ color: "#a0c8f0" }] }
        ]
    });

    geocoder = new google.maps.Geocoder();
    distanceService = new google.maps.DistanceMatrixService();

    marker = new google.maps.Marker({
        position: defaultPos,
        map: map,
        draggable: true,
        title: "Lokasi Tujuan"
    });

    const input = document.getElementById("destination");
    autocomplete = new google.maps.places.Autocomplete(input, {
        componentRestrictions: { country: "id" },
        fields: ["geometry", "formatted_address"],
    });

    autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        if (!place.geometry) return;

        const location = place.geometry.location;
        map.panTo(location);
        marker.setPosition(location);
    });

    map.addListener("click", (e) => {
        marker.setPosition(e.latLng);
    });

    document.getElementById("checkCostBtn").addEventListener("click", () => {
        const pos = marker.getPosition();
        updateOngkir(pos.lat(), pos.lng());
    });
};

function updateOngkir(lat, lng) {
    const outputDiv = document.getElementById("output");
    outputDiv.style.display = "none";
    outputDiv.classList.remove("show");

    geocoder.geocode({ location: { lat, lng } }, (results, status) => {
        const tujuanSpan = document.getElementById('tujuan');
        if (status === "OK" && results[0]) {
            tujuanSpan.textContent = results[0].formatted_address;
        } else {
            tujuanSpan.textContent = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
        }
    });

    distanceService.getDistanceMatrix({
        origins: [tokoPos],
        destinations: [{ lat, lng }],
        travelMode: google.maps.TravelMode.DRIVING,
    }, (response, status) => {
        const distanceSpan = document.getElementById('distance');
        const costSpan = document.getElementById('cost');

        if (status === "OK") {
            const element = response.rows[0].elements[0];
            const distanceText = element.distance.text;
            const distanceValue = element.distance.value; 
            distanceSpan.textContent = distanceText;

            const distanceKm = distanceValue / 1000;
            const ongkir = distanceKm > 2 ? Math.ceil((distanceKm - 2) * 2000) : 0;

            costSpan.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(ongkir);

            outputDiv.style.display = 'block';
            setTimeout(() => outputDiv.classList.add('show'), 10);
        }
    });
}
