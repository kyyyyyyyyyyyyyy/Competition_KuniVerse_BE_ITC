<?php

namespace Modules\UMKMProduct\Http\Livewire;

use Livewire\Component;

class ShoppingCart extends Component
{
    public $cartItems = [];
    public $isCartOpen = false;
    
    protected $listeners = [
        'productAddedToCart' => 'addToCart',
        'showProductDetail' => 'showDetail',
        'toggleCart' => 'toggleCart'
    ];
    
    public function mount()
    {
        // Load cart dari session atau database
        $this->cartItems = session()->get('cart', []);
    }
    
    public function addToCart($product)
    {
        // Logic untuk menambah ke keranjang
        $cartItemId = $product['sizes'] 
            ? $product['id'] . '-' . ($product['selectedSize'] ?? '')
            : $product['id'];
            
        $existingItem = collect($this->cartItems)->firstWhere('cartItemId', $cartItemId);
        
        if ($existingItem) {
            $this->cartItems = collect($this->cartItems)->map(function ($item) use ($cartItemId) {
                if ($item['cartItemId'] === $cartItemId) {
                    $item['qty'] += 1;
                }
                return $item;
            })->toArray();
        } else {
            $this->cartItems[] = [
                ...$product,
                'cartItemId' => $cartItemId,
                'selectedSize' => $product['selectedSize'] ?? null,
                'qty' => 1
            ];
        }
        
        session()->put('cart', $this->cartItems);
        
        // Show success message
        $this->dispatchBrowserEvent('show-success-modal', ['product' => $product]);
    }
    
    public function removeFromCart($cartItemId)
    {
        $this->cartItems = collect($this->cartItems)
            ->reject(function ($item) use ($cartItemId) {
                return $item['cartItemId'] === $cartItemId;
            })
            ->values()
            ->toArray();
            
        session()->put('cart', $this->cartItems);
    }
    
    public function toggleCart()
    {
        $this->isCartOpen = !$this->isCartOpen;
    }
    
    public function checkout()
    {
        // Logic untuk checkout
        session()->flash('message', 'Fitur checkout dalam pengembangan!');
        $this->isCartOpen = false;
    }
    
    public function render()
    {
        $totalItems = collect($this->cartItems)->sum('qty');
        $totalPrice = collect($this->cartItems)->sum(function ($item) {
            return ($item['price'] ?? 0) * ($item['qty'] ?? 0);
        });
        
        return view('umkmproduct::livewire.shopping-cart', [
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice,
        ]);
    }
}