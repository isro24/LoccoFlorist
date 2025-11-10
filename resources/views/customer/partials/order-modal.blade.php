<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content floral-modal">
      <div class="modal-body p-4 p-md-5">

        <div class="d-flex justify-content-end mb-3">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="text-center mb-4">
          <img src="{{ asset('storage/' . $product->image) }}" 
               alt="{{ $product->name }}" 
               class="img-preview rounded-4 shadow-sm">
        </div>

        <h4 class="text-center fw-bold text-pink mb-1">Formulir Pemesanan</h4>
        <p class="text-center text-muted mb-4 fs-6">{{ $product->name }}</p>

        <form action="{{ route('order.send') }}" method="POST"> 
          @csrf
          <input type="hidden" name="nama_produk" value="{{ $product->name }}">

          <!-- Quantity -->
          <div class="d-flex justify-content-end align-items-center mb-4">
            <label class="fw-semibold me-2 mb-0">Jumlah:</label>
            <div class="quantity-control d-flex align-items-center">
              <button type="button" class="btn-qty" id="decreaseQty">−</button>
              <input type="number" name="quantity" id="quantityInput" class="floral-input text-center mx-2" value="1" min="1" required style="width: 60px;">
              <button type="button" class="btn-qty" id="increaseQty">+</button>
            </div>
          </div>

          <div class="row g-3">
            <!-- Tipe -->
            <div class="col-12 col-md-6">
              <label class="form-label fw-semibold">Tipe</label>
              <select name="type" id="productTypeSelect" class="form-select floral-input" required oninvalid="this.setCustomValidity('Mohon pilih tipe produk')" oninput="this.setCustomValidity('')">
                <option value="">Pilih Tipe</option>
                <option value="Sewa papan">Sewa papan</option>
                <option value="Bucket">Bucket</option>
              </select>
              @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Nama Pemesan -->
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Nama Pemesan</label>
                <input type="text" name="name" class="form-control floral-input" required oninvalid="this.setCustomValidity('Mohon masukkan nama pemesan')" oninput="this.setCustomValidity('')" placeholder="Contoh: Sinta Rahayu">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipe Papan -->
            <div class="col-12" id="boardTypeWrapper" style="display:none;">
                <label class="form-label fw-semibold">Tipe Papan</label>
                <input type="text" name="board_type" class="form-control floral-input" 
                      disabled 
                      placeholder="Contoh: Papan Ucapan Selamat"
                      required oninvalid="this.setCustomValidity('Mohon masukkan tipe papan')" oninput="this.setCustomValidity('')"> 
                  @error('board_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal & Jam -->
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Tanggal Pengantaran</label>
                <input type="date" name="delivery_date" class="form-control floral-input" required oninvalid="this.setCustomValidity('Mohon masukkan tanggal pengantaran')" oninput="this.setCustomValidity('')">
                @error('delivery_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold">Jam Pengantaran</label>
                <input type="time" name="delivery_time" class="form-control floral-input" required oninvalid="this.setCustomValidity('Mohon masukkan jam pengantaran')" oninput="this.setCustomValidity('')">
                @error('delivery_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor Penerima -->
            <div class="col-12">
                <label class="form-label fw-semibold">Nomor Penerima</label>
                <input id="receiver_phone" type="text" inputmode="numeric" name="receiver_phone" class="form-control floral-input" 
                       required oninvalid="this.setCustomValidity('Mohon masukkan nomor penerima')" oninput="this.setCustomValidity('')"
                       pattern="[0-9]{9,14}" 
                       placeholder="Contoh: 081234567890">
                @error('receiver_phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="col-12">
                <label class="form-label fw-semibold">Lokasi Penerima</label>
                <input type="text" id="map-search-input" class="form-control floral-input mb-2" placeholder="Cari alamat atau nama tempat...">
                <div id="map" class="map-container mb-2 rounded-3" style="height: 200px; background: #f0f0f0;"></div>
                <input type="text" name="receiver_location" id="receiver_location" class="form-control floral-input" placeholder="Lokasi akan terisi otomatis" readonly required>
            </div>

            <!-- Format Kalimat -->
            <div class="col-12" id="formatKalimatWrapper" style="display:none;">
              <hr>
              <h6 class="fw-bold text-pink mb-3">Format Kalimat (Untuk Tipe Sewa Papan)</h6>

              <div class="mb-3">
                <label class="form-label fw-semibold">Nama + Gelar</label>
                <input type="text" name="nama_gelar" class="form-control floral-input" disabled placeholder="Contoh: Dr. Sinta Rahayu, M.Pd." required oninvalid="this.setCustomValidity('Mohon masukkan nama + gelar')" oninput="this.setCustomValidity('')">
                @error('name_gelar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Note</label>
                <textarea name="note_text" class="form-control floral-input" rows="2" disabled placeholder="Ucapan singkat di papan..." required oninvalid="this.setCustomValidity('Mohon masukkan note')" oninput="this.setCustomValidity('')"></textarea>
                @error('note_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">From</label>
                <input type="text" name="from_text" class="form-control floral-input" disabled placeholder="Dari siapa..." required oninvalid="this.setCustomValidity('Mohon masukkan dari siapa')" oninput="this.setCustomValidity('')">
                @error('from_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn text-white btn-floral px-4 py-2 rounded-4 fw-semibold w-100 w-md-auto">
              Pesan Sekarang
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>