<div id="detailModal" class="fixed inset-0 flex items-center justify-center z-50 p-4 opacity-0 pointer-events-none transition-opacity duration-300">
  <div id="detailModalOverlay" class="absolute inset-0 bg-black/25 transition-opacity duration-300"></div>

  <div id="detailModalContent" class="bg-white rounded-xl shadow-lg w-full sm:max-w-md md:max-w-3xl max-h-[90vh] overflow-auto relative transform scale-95 opacity-0 transition-all duration-300">
    
    <div class="flex justify-between items-center p-4 border-b bg-pinkBg text-white rounded-t-xl sticky top-0 z-10">
      <h3 class="text-lg font-semibold">Detail Produk</h3>
      <button id="closeDetailModal" class="text-white text-2xl font-bold">&times;</button>
    </div>

    <div class="p-6 grid md:grid-cols-2 gap-6">
      <div class="text-center">
        <div id="detail-image" class="mb-3"></div>
      </div>
      <div>
        <table class="w-full text-left">
          <tr><th class="text-gray-400 w-1/3">Nama</th><td id="detail-name"></td></tr>
          <tr><th class="text-gray-400">Kategori</th><td id="detail-category"></td></tr>
          <tr><th class="text-gray-400">Harga</th><td id="detail-price"></td></tr>
          <tr><th class="text-gray-400">Status</th><td id="detail-status"></td></tr>
          <tr>
            <th class="text-gray-400 align-top">Deskripsi</th>
            <td><div id="detail-description" class="max-h-60 overflow-auto wrap-break-word p-2 rounded"></div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
