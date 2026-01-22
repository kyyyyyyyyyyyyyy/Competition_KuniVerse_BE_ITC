<div class="bg-[#FDFCF9] min-h-screen font-sans text-gray-800 relative">

    {{-- Popup Detail Produk --}}
    @if($detailProduct)
    <div class="fixed inset-0 z-[110] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70" wire:click="$set('detailProduct', null)"></div>
        <div class="bg-white rounded-3xl overflow-hidden w-full max-w-4xl relative z-10 shadow-2xl flex flex-col md:flex-row h-[85vh] md:h-auto">
            <div class="w-full md:w-1/2 bg-gray-100 relative h-64 md:h-auto">
                <img src="{{ $detailProduct->image }}" alt="{{ $detailProduct->name }}" class="w-full h-full object-cover">
                <button wire:click="$set('detailProduct', null)" class="absolute top-4 left-4 md:hidden bg-white/50 p-2 rounded-full">
                    <span class="material-icons-round">arrow_back</span>
                </button>
            </div>
            <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col h-full overflow-y-auto">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $detailProduct->category }}</span>
                    <button wire:click="$set('detailProduct', null)" class="hidden md:block text-gray-400 hover:text-gray-600 cursor-pointer"><span class="material-icons-round text-2xl">close</span></button>
                </div>
                <h2 class="font-serif text-3xl font-bold text-gray-900 mb-2">{{ $detailProduct->name }}</h2>
                <div class="flex items-center gap-4 mb-6 text-3xl font-bold text-[#C5A059]">Rp {{ number_format($detailProduct->price,0,',','.') }}</div>

                {{-- Pilih Ukuran --}}
                @if($detailProduct->sizes)
                <div class="mb-6">
                    <h4 class="font-bold text-gray-900 mb-3 text-sm">Pilih Ukuran:</h4>
                    <div class="flex flex-wrap gap-3">
                        @foreach($detailProduct->sizes as $size)
                            <button wire:click="$set('selectedSize', '{{ $size }}')"
                                class="w-10 h-10 rounded-lg text-sm font-bold border transition-all
                                {{ $selectedSize == $size ? 'bg-[#C5A059] text-white border-[#C5A059] shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:border-[#C5A059] hover:text-[#C5A059]' }}">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-8 flex-1">
                    <h4 class="font-bold text-gray-900 mb-2">Deskripsi Produk</h4>
                    <p class="text-gray-600 leading-relaxed text-sm">{{ $detailProduct->fullDesc }}</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-auto pt-4 border-t border-gray-100">
                    <button wire:click="addToCart({{ $detailProduct->id }})"
                        @if($detailProduct->sizes && !$selectedSize) disabled @endif
                        class="w-full py-3.5 px-4 rounded-xl text-white font-bold {{ $detailProduct->sizes && !$selectedSize ? 'bg-gray-300 cursor-not-allowed' : 'bg-[#C5A059] hover:bg-[#b08d4b]' }}">
                        <span class="material-icons-round text-xl">add_shopping_cart</span> Masuk Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Header --}}
    <header class="pt-32 pb-8 text-center max-w-4xl mx-auto px-6">
        <h2 class="font-serif text-5xl md:text-6xl text-[#C5A059] mb-4 drop-shadow-sm font-bold">UMKM Kuningan</h2>
        <p class="text-gray-600 text-lg leading-relaxed font-medium mb-8">Temukan produk lokal unggulan dari UMKM terbaik di Kabupaten Kuningan.</p>

        {{-- Search Bar --}}
        <div class="max-w-md mx-auto relative group">
            <input type="text" placeholder="Cari produk..." wire:model.debounce.300ms="searchQuery"
                class="w-full pl-12 pr-4 py-3.5 rounded-full border border-gray-200 bg-white focus:border-[#C5A059] focus:ring-4 focus:ring-[#C5A059]/10 outline-none transition-all shadow-md">
            <span class="material-icons-round absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
        </div>
    </header>

    {{-- Filter & Grid --}}
    <main class="max-w-7xl mx-auto px-6 pb-24">
        <div class="mb-8 flex flex-wrap justify-center gap-3">
            @foreach($categories as $category)
                <button wire:click="selectCategory('{{ $category }}')"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 shadow-sm cursor-pointer border {{ $selectedCategory == $category ? 'bg-[#C5A059] text-white border-[#C5A059] scale-105' : 'bg-white text-gray-600 border-gray-200 hover:border-[#C5A059] hover:text-[#C5A059]' }}">
                    {{ $category }}
                </button>
            @endforeach
        </div>

        {{-- Product Grid --}}
        @if($this->filteredProducts->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($this->filteredProducts as $item)
            <div wire:click="openDetail({{ $item->id }})"
                class="group bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col cursor-pointer">
                <div class="relative aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @if($item->tag)
                        <div class="absolute top-3 {{ str_contains($item->tag,'DISKON') ? 'left-3 bg-red-600 text-white' : 'right-3 bg-white text-[#C5A059]' }} px-3 py-1 rounded-lg text-xs font-bold shadow-md">{{ $item->tag }}</div>
                    @endif
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-lg mb-1 text-gray-900 group-hover:text-[#C5A059] transition-colors line-clamp-1">{{ $item->name }}</h3>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <div><span class="text-[#C5A059] font-bold text-xl block">Rp {{ number_format($item->price,0,',','.') }}</span></div>
                        <button wire:click.stop="{{ $item->sizes ? "openDetail($item->id)" : "addToCart($item->id)" }}"
                            class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 hover:bg-[#C5A059] hover:text-white active:scale-90 transition-all flex items-center justify-center shadow-sm z-10 cursor-pointer">
                            <span class="material-icons-round text-xl">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
            <span class="material-icons-round text-6xl text-gray-200 mb-4">search_off</span>
            <p class="text-gray-500 font-medium">Produk tidak ditemukan.</p>
            <button wire:click="resetSearch" class="mt-2 bg-[#C5A059] text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-[#b08d4b]">Reset Pencarian</button>
        </div>
        @endif
    </main>
</div>
