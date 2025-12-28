<div id="detailModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300 ease-out">
    
    <div id="detailModalOverlay" class="absolute inset-0 bg-black/50 transition-opacity duration-300"></div>

    <div id="detailModalContent" class="bg-white rounded-2xl shadow-2xl w-full sm:max-w-lg md:max-w-4xl max-h-[90vh] flex flex-col relative transform scale-95 opacity-0 transition-all duration-300 overflow-hidden">
        
        <div class="flex-shrink-0 flex justify-between items-center px-6 py-4 bg-pinkButton text-white shadow-sm z-10">
            <h3 class="text-lg font-bold font-serif tracking-wide">Detail Produk</h3>
            <button id="closeDetailModal" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 text-white transition duration-200">
                <span class="text-2xl leading-none">&times;</span>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <div class="flex flex-col md:flex-row h-full">
                
                <div class="w-full md:w-5/12 flex items-center justify-center p-6">
                    <div id="detail-image" class="w-full h-full flex items-center justify-center rounded-xl overflow-hidden relative">
                      </div>
                </div>

                <div class="w-full md:w-7/12 p-6 md:p-8">
                    
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span id="detail-category" class="px-3 py-1 bg-pink-50 text-pink-600 text-xs font-bold uppercase tracking-wider rounded-full border border-pink-100"></span>
                        <span id="detail-status"></span>
                    </div>

                    <h2 id="detail-name" class="text-2xl md:text-3xl font-bold font-serif text-gray-900 leading-tight mb-2"></h2>

                    <div id="detail-price" class="text-2xl font-bold text-pinkButton mb-6"></div>

                    <div class="h-px w-full bg-gray-100 mb-6"></div>

                    <div class="mb-2">
                        <h5 class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Deskripsi Produk</h5>
                        <div id="detail-description" class="text-sm text-gray-600 leading-relaxed text-justify bg-gray-50 p-4 rounded-xl border border-gray-100"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>