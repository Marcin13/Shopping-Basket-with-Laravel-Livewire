<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class BasketButton extends Component
{
    /**
     * @var int
     */
    public int $qty = 0;
    //to bedzie nasłuchiwać na $this->emit('basketUpdated'); jak sie wykona to my to wykonamy update
protected $listeners = ['basketUpdated'=>'update'];

    public function mount(): void
    {
        $this->update();
    }
    public function update(): void
    {
$this->qty = array_sum(basket()->all()); //wszystkie sumy zwracane z sesji będą dodawane
    }
    public function toggle(): void
    {
        $this->emit('toggleBasket');
     }
    /**y
     * @return View
     */
    public function render(): View
    {
        return view('livewire.basket-button');
    }
}
