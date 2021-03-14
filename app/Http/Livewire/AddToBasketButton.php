<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class AddToBasketButton extends Component
{
    /*Mount component
    * @param int $productId
     */
    /**
     * @var int|mixed
     */
    public $qty = 1;
    public int $productId;
    public int $currentQty = 0;

    /**
     * mounting $productId to view
     * @param int $productId
     */
    public function mount(int $productId): void
    {
        $this->productId = $productId;
    }

    public function hydrate(): void
    {
        $this->currentQty = basket()->getCurrentQty($this->productId);
    }

    public function add(): void
    {
        $qty = $this->currentQty + (int)$this->qty;
        if ($qty < 1) {
            return;
        }
        basket()->add($this->productId, $qty);
        $this->qty = 1; //reset to 1, after add to basket click
        $this->emit('basketUpdated');
        // dd(basket());
    }

    public function render(): View
    {
        return view('livewire.add-to-basket-button');
    }
}
