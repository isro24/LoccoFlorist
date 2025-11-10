$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Load tabel
    function loadTable(url) {
        $.ajax({
            url: url,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(html) {
                $('#table-view').html(html);
            },
            error: function() {
                alert('Gagal memuat data');
            }
        });
    }

    // Pagination
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        loadTable(url);
    });

    // Delete Produk
    $(document).on('click', '.btn-delete', function() {
        const productId = $(this).data('id');
        Swal.fire({
            title: 'Yakin hapus produk ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ff4d94',
            cancelButtonColor: '#6c757d',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/product/${productId}`,
                    type: 'POST',
                    data: { '_method': 'DELETE' },
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    success: function(response) {
                        $('#product-row-' + productId).fadeOut(400, function() { $(this).remove(); });
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.success,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal menghapus produk', 'error');
                    }
                });
            }
        });
    });

    // Preview gambar saat upload
    $('#image').on('change', function() {
        const previewContainer = $('#image-preview').html('');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.append(`<img src="${e.target.result}" class="img-fluid rounded d-block mx-auto shadow-sm" style="max-height:200px;">`);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('detailModal');
  const modalContent = document.getElementById('detailModalContent');
  const closeBtn = document.getElementById('closeDetailModal');

  function openModal() {
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100');

    modalContent.classList.remove('scale-95', 'opacity-0');
    modalContent.classList.add('scale-100', 'opacity-100');
  }

  function closeModal() {
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');

    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');

    setTimeout(() => modal.classList.add('pointer-events-none'), 300);
  }

  closeBtn.addEventListener('click', closeModal);

  document.getElementById('detailModalOverlay').addEventListener('click', closeModal);

  document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', function() {
      const productId = this.dataset.id;
      openModal();

      document.getElementById('detail-name').textContent = 'Memuat...';
      document.getElementById('detail-category').textContent = 'Memuat...';
      document.getElementById('detail-price').textContent = 'Memuat...';
      document.getElementById('detail-status').textContent = 'Memuat...';
      document.getElementById('detail-description').textContent = 'Memuat...';
      document.getElementById('detail-image').innerHTML = `<div class="bg-gray-200 rounded-lg flex items-center justify-center h-64 animate-pulse"></div>`;

      fetch(`/admin/product/${productId}`)
        .then(res => res.json())
        .then(product => {
          document.getElementById('detail-name').textContent = product.name;
          document.getElementById('detail-category').textContent = product.category ? product.category.name : '-';
          document.getElementById('detail-price').textContent = `Rp ${Number(product.price).toLocaleString('id-ID')}`;
          document.getElementById('detail-status').innerHTML = product.status
            ? '<span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm">Tersedia</span>'
            : '<span class="inline-block bg-gray-400 text-white px-3 py-1 rounded-full text-sm">Tidak Tersedia</span>';
          document.getElementById('detail-description').innerHTML = (product.description || '-').replace(/\n/g, '<br>');
          document.getElementById('detail-image').innerHTML = product.image
            ? `<img src="/storage/${product.image}" class="w-full h-64 object-cover rounded-lg shadow-sm">`
            : `<div class="bg-gray-200 rounded-lg flex items-center justify-center h-64"><i class="bi bi-image text-5xl text-gray-400"></i></div>`;
        })
        .catch(() => {
          alert('Gagal memuat detail produk');
          closeModal();
        });
    });
  });
});
