<div>

    <!-- Search Input -->
    <div class="mb-6 text-center">
        <input type="text"
               wire:model.debounce.300ms="search"
               placeholder="Cari produk..."
               class="border px-4 py-2 rounded w-full max-w-md" />
    </div>

    <!-- Product List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="border p-4 rounded shadow-sm">
                <h3 class="font-bold">{{ $product['name'] }}</h3>
                <p class="text-sm line-clamp-2">{{ $product['description'] ?? $product['fullDesc'] ?? '' }}</p>
                <p class="text-xs text-gray-500">{{ $product['category'] ?? '' }}</p>
                <p class="text-sm font-semibold mt-2">{{ formatRupiah($product['price'] ?? 0) }}</p>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Tidak ada produk ditemukan.</p>
        @endforelse
    </div>
</div>
