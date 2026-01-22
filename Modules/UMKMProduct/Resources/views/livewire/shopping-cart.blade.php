<!-- Floating Cart Button & Popup -->
<div class="fixed bottom-8 right-8 z-50">
    <!-- Cart Popup -->
    @if($isCartOpen)
        <div class="w-[350px] bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col mb-4 animate-in fade-in">
            <div class="p-4 flex justify-between items-center border-b border-gray-100 bg-white">
                <h3 class="text-[#C5A059] font-bold text-lg tracking-tight flex items-center gap-2">
                    <span class="material-icons-round">shopping_bag</span>
                    Keranjang ({{ $totalItems }})
                </h3>
                <button wire:click="toggleCart" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <span class="material-icons-round">close</span>
                </button>
            </div>
            <div class="max-h-[350px] overflow-y-auto bg-gray-50 p-2">
                @if(count($cartItems) === 0)
                    <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                        <span class="material-icons-round text-4xl mb-2 text-gray-300">remove_shopping_cart</span>
                        <p class="text-sm">Keranjang masih kosong</p>
                    </div>
                @else
                    @foreach($cartItems as $item)
                        <div class="flex gap-3 p-3 bg-white rounded-xl border border-gray-100 shadow-sm mb-2 relative group">
                            <div class="relative shrink-0 w-16 h-16">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full rounded-lg object-cover">
                            </div>
                            <div class="flex-1 min-w-0 flex flex-col justify-center">
                                <h4 class="font-bold text-sm text-gray-800 truncate">{{ $item['name'] }}</h4>
                                @if($item['selectedSize'])
                                    <div class="text-xs text-gray-500 font-medium bg-gray-100 inline-block px-1.5 py-0.5 rounded w-fit mb-1">
                                        Size: {{ $item['selectedSize'] }}
                                    </div>
                                @endif
                                <p class="text-[#C5A059] font-bold text-xs mt-0.5">
                                    {{ formatRupiah($item['price']) }} 
                                    <span class="text-gray-400 font-normal">x {{ $item['qty'] }}</span>
                                </p>
                            </div>
                            <button wire:click="removeFromCart('{{ $item['cartItemId'] }}')" class="absolute top-2 right-2 text-gray-300 hover:text-red-500 cursor-pointer">
                                <span class="material-icons-round text-lg">delete</span>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="p-4 bg-white border-t border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-500 text-sm">Total Belanja</span>
                    <span class="font-bold text-xl text-[#C5A059]">{{ formatRupiah($totalPrice) }}</span>
                </div>
                <button wire:click="checkout" class="w-full py-3 rounded-xl bg-[#C5A059] text-white font-bold hover:bg-[#b08d4b] shadow-lg shadow-[#C5A059]/20 transition-colors cursor-pointer text-sm">
                    CHECKOUT SEKARANG
                </button>
            </div>
        </div>
    @endif
    
    <!-- Cart Button -->
    <div class="flex justify-end">
        <button wire:click="toggleCart" class="bg-[#C5A059] text-white p-4 rounded-full shadow-xl hover:bg-[#b08d4b] hover:-translate-y-1 transition-all flex items-center gap-3 pr-6 cursor-pointer border-4 border-white group">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                <span class="material-icons-round text-2xl">{{ $isCartOpen ? 'close' : 'shopping_basket' }}</span>
            </div>
            <div class="flex flex-col items-start leading-tight">
                <span class="font-bold tracking-wide text-sm">KERANJANG</span>
                @if($totalItems > 0)
                    <span class="text-[10px] opacity-90">{{ $totalItems }} Item | {{ formatRupiah($totalPrice) }}</span>
                @endif
            </div>
        </button>
    </div>
</div>