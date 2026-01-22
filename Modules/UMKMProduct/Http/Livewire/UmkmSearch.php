<?php

namespace Modules\UMKMProduct\Http\Livewire;

use Livewire\Component;
use Modules\UMKMProduct\Models\UmkmProduct;

class UmkmSearch extends Component
{
    public $search = '';
    public $products = [];           // Semua produk
    public $filteredProducts = [];   // Produk hasil filter
    public $selectedCategory = 'Semua Produk';

    protected $listeners = ['categorySelected' => 'filterByCategory'];

    public function mount($products = [])
    {
        // Pastikan selalu array
        $this->products = is_array($products) ? $products : [];
        $this->filteredProducts = $this->products;
    }

    public function updatedSearch()
    {
        $this->filterProducts();
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->filterProducts($category);
    }

    private function filterProducts($category = null)
    {
        $category = $category ?? $this->selectedCategory;

        $this->filteredProducts = collect($this->products)
            ->filter(function($item) use ($category) {
                $matchCategory = !$category || $category === 'Semua Produk'
                    ? true
                    : $item['category'] === $category;

                $matchSearch = empty($this->search)
                    ? true
                    : str_contains(strtolower($item['name']), strtolower($this->search)) ||
                      str_contains(strtolower($item['description']), strtolower($this->search));

                return $matchCategory && $matchSearch;
            })
            ->values()
            ->all();
    }

    public function render()
    {
        // Kirim nama variabel yang sama dengan Blade
        return view('umkmproduct::livewire.umkm-search', [
            'products' => $this->filteredProducts,
            'selectedCategory' => $this->selectedCategory,
        ]);
    }
}
