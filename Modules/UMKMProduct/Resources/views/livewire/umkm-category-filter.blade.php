<div class="mb-8 flex flex-wrap justify-center gap-3">
    @foreach($categories as $category)
        <button
            wire:click="selectCategory('{{ $category }}')"
            class="px-6 py-2.5 rounded-full whitespace-nowrap text-sm font-bold transition-all duration-300 shadow-sm cursor-pointer border 
                   {{ $selectedCategory === $category 
                      ? 'bg-[#C5A059] text-white border-[#C5A059] shadow-md transform scale-105' 
                      : 'bg-white text-gray-600 border-gray-200 hover:border-[#C5A059] hover:text-[#C5A059]' }}"
        >
            {{ $category }}
        </button>
    @endforeach
</div>