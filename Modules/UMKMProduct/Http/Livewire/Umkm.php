<?php

namespace Modules\UMKMProduct\Http\Livewire;

use Livewire\Component;
use Modules\UMKMProduct\Models\UMKMProduct;

class Umkm extends Component
{
    public $searchQuery = '';
    public $selectedCategory = 'Semua Produk';
    public $categories = ['Semua Produk', 'Makanan', 'Minuman', 'Camilan', 'Kerajinan', 'Fashion'];

    public $cartItems = [];
    public $addedProduct = null;
    public $detailProduct = null;
    public $selectedSize = null;
    public $isCartOpen = false;

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function openDetail($productId)
    {
        $this->detailProduct = UMKMProduct::find($productId);
        $this->selectedSize = null;
    }

    public function addToCart($productId)
    {
        $product = UMKMProduct::find($productId);

        if($product->sizes && !$this->selectedSize){
            session()->flash('error', 'Harap pilih ukuran terlebih dahulu!');
            return;
        }

        $cartItemId = $product->sizes ? $product->id.'-'.$this->selectedSize : $product->id;

        $found = false;
        foreach($this->cartItems as &$item){
            if($item['cartItemId'] == $cartItemId){
                $item['qty'] += 1;
                $found = true;
                break;
            }
        }

        if(!$found){
            $this->cartItems[] = [
                'cartItemId' => $cartItemId,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'selectedSize' => $this->selectedSize,
                'qty' => 1
            ];
        }

        $this->addedProduct = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'selectedSize' => $this->selectedSize
        ];

        $this->detailProduct = null;
        $this->selectedSize = null;
    }

    public function removeFromCart($cartItemId)
    {
        $this->cartItems = array_filter($this->cartItems, fn($item) => $item['cartItemId'] != $cartItemId);
    }

    public function resetSearch()
    {
        $this->searchQuery = '';
        $this->selectedCategory = 'Semua Produk';
    }

    public function getFilteredProductsProperty()
    {
        return UMKMProduct::when($this->selectedCategory != 'Semua Produk', function($query){
                $query->where('category', $this->selectedCategory);
            })
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchQuery.'%')
                  ->orWhere('location', 'like', '%'.$this->searchQuery.'%');
            })
            ->get();
    }

    public function render()
    {
        $totalPrice = array_sum(array_map(fn($i)=> $i['price']*$i['qty'], $this->cartItems));
        $totalItems = array_sum(array_map(fn($i)=> $i['qty'], $this->cartItems));

        return view('livewire.umkm', compact('totalPrice', 'totalItems'));
    }
}
