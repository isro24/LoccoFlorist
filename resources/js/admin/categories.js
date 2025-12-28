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

    // Pagination AJAX
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        const url = $(this).attr("href");

        $.ajax({
            url: url,
            headers: { "X-Requested-With": "XMLHttpRequest" },
            success: function (html) {
                $("#table-view").html(html);
            },
            error: function () {
                Swal.fire("Error", "Gagal memuat data kategori", "error");
            },
        });
    });

    // Hapus kategori
    $(document).on("click", ".btn-delete", function () {
        const categoryId = $(this).data("id");

        Swal.fire({
            title: "Yakin ingin menghapus kategori ini?",
            text: "Aksi ini tidak bisa dibatalkan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#e53935",
            cancelButtonColor: "#6c757d",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/category/${categoryId}`,
                    type: "POST",
                    data: { _method: "DELETE" },
                    headers: { "X-CSRF-TOKEN": csrfToken },
                    success: function (response) {
                        $("#category-row-" + categoryId).fadeOut(
                            300,
                            function () {
                                $(this).remove();

                                $("#table-view tbody tr").each(function (
                                    index
                                ) {
                                    $(this)
                                        .find("td:first")
                                        .text(index + 1);
                                });
                            }
                        );

                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: response.success,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    },
                    error: function () {
                        Swal.fire("Error", "Gagal menghapus kategori", "error");
                    },
                });
            }
        });
    });
});
