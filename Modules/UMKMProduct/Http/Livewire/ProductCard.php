<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\UMKMProduct\Models\UmkmProduct;

class ProductCard extends Component
{
    public $product;
    
    public function mount($product)
    {
        $this->product = $product;
    }
    
    public function addToCart()
    {
        // Logic untuk menambah ke keranjang
        $this->emit('productAddedToCart', $this->product);
    }
    
    public function showDetail()
    {
        $this->emit('showProductDetail', $this->product);
    }
    
    public function render()
    {
        return view('umkmproduct::livewire.product-card');
    }
}