<div 
    wire:click="showDetail"
    class="group bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full cursor-pointer"
>
    <div class="relative aspect-square overflow-hidden bg-gray-100">
        <img 
            src="{{ $product['image'] }}" 
            alt="{{ $product['name'] }}" 
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
            loading="lazy"
        >
        @if(!empty($product['tag']))
            <div class="absolute top-3 {{ strpos($product['tag'], 'DISKON') !== false ? 'left-3 bg-red-600 text-white' : 'right-3 bg-white text-[#C5A059]' }} px-3 py-1 rounded-lg text-xs font-bold shadow-md">
                {{ $product['tag'] }}
            </div>
        @endif
        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <span class="bg-white/90 backdrop-blur px-4 py-2 rounded-full text-xs font-bold text-gray-800 shadow-sm transform translate-y-4 group-hover:translate-y-0 transition-transform">
                Lihat Detail
            </span>
        </div>
    </div>
    <div class="p-5 flex flex-col flex-grow">
        <div class="flex items-center gap-1.5 mb-2">
            <span class="material-icons-round text-orange-400 text-sm">star</span>
            <span class="text-sm font-bold text-gray-900">{{ $product['rating'] }}</span>
            <span class="text-gray-300 text-xs">•</span>
            <span class="text-xs text-gray-500">{{ $product['reviews'] }} ulasan</span>
        </div>
        <h3 class="font-bold text-lg mb-1 text-gray-900 group-hover:text-[#C5A059] transition-colors line-clamp-1">
            {{ $product['name'] }}
        </h3>
        <div class="flex items-center gap-1 text-gray-400 text-xs mb-3">
            <span class="material-icons-round text-[14px]">location_on</span>
            {{ $product['location'] }}
        </div>
        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
            <div>
                <span class="text-[#C5A059] font-bold text-xl block">
                    {{ formatRupiah($product['price']) }}
                </span>
            </div>
            <button 
                wire:click.stop="addToCart"
                class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 hover:bg-[#C5A059] hover:text-white active:scale-90 transition-all flex items-center justify-center shadow-sm z-10 cursor-pointer"
            >
                <span class="material-icons-round text-xl">add_shopping_cart</span>
            </button>
        </div>
    </div>
</div>