<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use App\Facades\Cart;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function render()
    {

        $products = Product::paginate(12);

        if($this->search !== null){
            $products= Product::where('name', 'like', '%'. $this->search . '%')->paginate(10);
        }

        return view('livewire.product-index',[
            'products' => $products,
        ]);
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());

        $this->emit('cartAdded');
    }
}
