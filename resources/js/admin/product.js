$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    // Sweet Alert
    const flashSuccess = $("#flash-message").data("success");
    if (flashSuccess) {
        Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: flashSuccess,
            timer: 1500,
            showConfirmButton: false,
        });
    }

    // Load tabel
    function loadTable(url) {
        $.ajax({
            url: url,
            headers: { "X-Requested-With": "XMLHttpRequest" },
            success: function (html) {
                $("#table-view").html(html);
            },
            error: function () {
                alert("Gagal memuat data");
            },
        });
    }

    // Pagination
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        const url = $(this).attr("href");
        loadTable(url);
    });

    // Delete Produk
    $(document).on("click", ".btn-delete", function () {
        const productId = $(this).data("id");
        Swal.fire({
            title: "Yakin hapus produk ini?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff4d94",
            cancelButtonColor: "#6c757d",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/product/${productId}`,
                    type: "POST",
                    data: { _method: "DELETE" },
                    headers: { "X-CSRF-TOKEN": csrfToken },
                    success: function (response) {
                        $("#product-row-" + productId).fadeOut(
                            400,
                            function () {
                                $(this).remove();
                            }
                        );
                        $("#product-table tbody tr").each(function (index) {
                            $(this)
                                .find("td:first")
                                .text(index + 1);
                        });
                        loadTable(window.location.href);
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: response.success,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    },
                    error: function () {
                        Swal.fire("Error", "Gagal menghapus produk", "error");
                    },
                });
            }
        });
    });

    $(document).on("click", ".delete-extra-image", function () {
        const btn = $(this);
        const imageId = btn.data("id");
        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        Swal.fire({
            title: "Yakin hapus gambar ini?",
            text: "Gambar yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff4d94",
            cancelButtonColor: "#6c757d",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/product/image/${imageId}`,
                    type: "POST",
                    data: { _method: "DELETE", _token: csrfToken },
                    success: function (response) {
                        btn.closest("div").fadeOut(300, function () {
                            $(this).remove();
                        });
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: response.success,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    },
                    error: function () {
                        Swal.fire("Error", "Gagal menghapus gambar", "error");
                    },
                });
            }
        });
    });

    // Preview gambar saat upload
    $("#image").on("change", function () {
        const previewContainer = $("#image-preview").html("");
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.append(
                    `<img src="${e.target.result}" class="img-fluid rounded d-block mx-auto shadow-sm" style="max-height:200px;">`
                );
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    let extraImagesDT = new DataTransfer();
    const maxImages = 3;

    $("#extra_images").on("change", function () {
        const files = Array.from(this.files);
        const previewContainer = $("#extraImagesPreview");

        files.forEach((file) => {
            if (extraImagesDT.files.length >= maxImages) {
                alert("Maksimal 3 gambar tambahan");
                return;
            }

            extraImagesDT.items.add(file);

            const reader = new FileReader();
            reader.onload = function (e) {
                const index = extraImagesDT.files.length - 1;

                previewContainer.append(`
                    <div class="relative">
                        <img 
                            src="${e.target.result}" 
                            class="rounded shadow-sm"
                            style="width:120px;height:120px;object-fit:cover"
                        >
                        <button 
                            type="button"
                            class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-2 remove-image"
                            data-index="${index}">
                            ×
                        </button>
                    </div>
                `);
            };
            reader.readAsDataURL(file);
        });

        this.files = extraImagesDT.files;
    });

    document.querySelectorAll(".toggle-best-seller").forEach((toggle) => {
        toggle.addEventListener("change", function () {
            const productId = this.getAttribute("data-id");
            const isChecked = this.checked;

            fetch(`/admin/product/toggle-best-seller/${productId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    status: isChecked,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("Update sukses");
                    } else {
                        this.checked = !isChecked;
                        alert("Gagal mengubah status.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    this.checked = !isChecked;
                    alert("Terjadi kesalahan koneksi.");
                });
        });
    });
});

// Modal detail produk
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("detailModal");
    const modalContent = document.getElementById("detailModalContent");
    const closeBtn = document.getElementById("closeDetailModal");

    function openModal() {
        modal.classList.remove("opacity-0", "pointer-events-none");
        modal.classList.add("opacity-100");

        modalContent.classList.remove("scale-95", "opacity-0");
        modalContent.classList.add("scale-100", "opacity-100");
    }

    function closeModal() {
        modalContent.classList.remove("scale-100", "opacity-100");
        modalContent.classList.add("scale-95", "opacity-0");

        modal.classList.remove("opacity-100");
        modal.classList.add("opacity-0");

        setTimeout(() => modal.classList.add("pointer-events-none"), 300);
    }

    closeBtn.addEventListener("click", closeModal);
    document
        .getElementById("detailModalOverlay")
        .addEventListener("click", closeModal);

    document.querySelectorAll(".btn-detail").forEach((btn) => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.id;

            document.getElementById("detail-image").innerHTML =
                '<div class="h-64 flex items-center justify-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-pink-500"></div></div>';

            fetch(`/admin/product/${productId}`)
                .then((res) => res.json())
                .then((product) => {
                    document.getElementById("detail-name").textContent =
                        product.name;
                    document.getElementById("detail-category").textContent =
                        product.category ? product.category.name : "-";
                    document.getElementById(
                        "detail-price"
                    ).textContent = `Rp ${Number(product.price).toLocaleString(
                        "id-ID"
                    )}`;
                    document.getElementById("detail-status").innerHTML =
                        product.status
                            ? '<span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm">Tersedia</span>'
                            : '<span class="inline-block bg-gray-500 text-white px-3 py-1 rounded-full text-sm">Tidak Tersedia</span>';
                    document.getElementById("detail-description").innerHTML = (
                        product.description || "-"
                    ).replace(/\n/g, "<br>");

                    const imageContainer =
                        document.getElementById("detail-image");
                    let images = [];

                    if (product.image) {
                        images.push({
                            src: `/storage/${product.image}`,
                            alt: "Utama",
                        });
                    }

                    if (product.images && product.images.length > 0) {
                        product.images.forEach((img) => {
                            images.push({
                                src: `/storage/${img.image}`,
                                alt: "Tambahan",
                            });
                        });
                    }

                    if (images.length === 0) {
                        imageContainer.innerHTML = `<div class="bg-gray-200 rounded-lg flex items-center justify-center h-64"><i class="bi bi-image text-5xl text-gray-400"></i></div>`;
                    } else if (images.length === 1) {
                        imageContainer.innerHTML = `<img src="${images[0].src}" class="w-full h-64 object-cover rounded-lg shadow-sm">`;
                    } else {
                        let sliderHtml = `
              <div class="relative w-full h-64 group bg-gray-100 rounded-lg overflow-hidden">
                  <div id="slider-track" class="w-full h-full relative">`;

                        images.forEach((img, index) => {
                            const hiddenClass = index === 0 ? "" : "hidden";
                            sliderHtml += `
                  <img src="${img.src}" 
                       class="slide-item w-full h-full object-cover absolute top-0 left-0 transition-opacity duration-300 ${hiddenClass}" 
                       data-index="${index}">`;
                        });

                        sliderHtml += `
                  </div>
                  
                  <button id="prevSlide" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-2 rounded-full backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
                      <i class="bi bi-chevron-left text-lg"></i>
                  </button>

                  <button id="nextSlide" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-2 rounded-full backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
                      <i class="bi bi-chevron-right text-lg"></i>
                  </button>

                  <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-1 rounded-md">
                    <span id="currentSlideNum">1</span> / ${images.length}
                  </div>
              </div>
            `;

                        imageContainer.innerHTML = sliderHtml;

                        let currentIndex = 0;
                        const slides =
                            imageContainer.querySelectorAll(".slide-item");
                        const totalSlides = slides.length;
                        const slideNumDisplay =
                            document.getElementById("currentSlideNum");

                        const updateSlide = () => {
                            slides.forEach((slide, idx) => {
                                if (idx === currentIndex) {
                                    slide.classList.remove("hidden");
                                } else {
                                    slide.classList.add("hidden");
                                }
                            });
                            if (slideNumDisplay)
                                slideNumDisplay.textContent = currentIndex + 1;
                        };

                        document
                            .getElementById("nextSlide")
                            .addEventListener("click", (e) => {
                                e.preventDefault();
                                currentIndex = (currentIndex + 1) % totalSlides;
                                updateSlide();
                            });

                        document
                            .getElementById("prevSlide")
                            .addEventListener("click", (e) => {
                                e.preventDefault();
                                currentIndex =
                                    (currentIndex - 1 + totalSlides) %
                                    totalSlides;
                                updateSlide();
                            });
                    }

                    openModal();
                })
                .catch((err) => {
                    console.error(err);
                    alert("Gagal memuat detail produk");
                });
        });
    });
});
