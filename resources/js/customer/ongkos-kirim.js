document.getElementById("cekTarifBtn").addEventListener("click", () => {
    const areaSelect = document.getElementById("areaTujuan");
    const area = areaSelect.value;
    const ongkir = areaSelect.options[areaSelect.selectedIndex].dataset.ongkir;

    if (!area) {
        alert("Pilih area tujuan terlebih dahulu!");
        return;
    }

    document.getElementById("outputArea").textContent = area;
    document.getElementById("outputOngkir").textContent = formatRupiah(
        parseInt(ongkir)
    );

    showOutput();
});

function showOutput() {
    const box = document.getElementById("output");
    box.classList.remove("hidden");

    setTimeout(() => {
        box.classList.add("opacity-100", "translate-y-0");
        box.classList.remove("opacity-0", "translate-y-3");
    }, 20);
}

function formatRupiah(value) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(value);
}
