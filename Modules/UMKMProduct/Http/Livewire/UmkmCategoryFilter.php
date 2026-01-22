<?php

namespace Modules\UMKMProduct\Http\Livewire;

use Livewire\Component;
use Modules\ProductCateory\Models\ProductCateory;
use Modules\UMKMProduct\Models\UmkmProduct;

class UmkmCategoryFilter extends Component
{
    public $categories = [];
    public $selectedCategory = 'Semua Produk';

    public function mount()
    {
        // Ambil semua kategori unik dari database
        $this->categories = ProductCateory::pluck('name', 'id')
            ->toArray();

        array_unshift($this->categories, 'Semua Produk');
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->emit('categorySelected', $category);
    }

    public function render()
    {
        return view('umkmproduct::livewire.umkm-category-filter');
    }
}
