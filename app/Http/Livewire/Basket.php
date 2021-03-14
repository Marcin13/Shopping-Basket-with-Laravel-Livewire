<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use Illuminate\Support\Collection;

class Basket extends Component
{
    public bool $visible = false;
    public array $basket = [];
    public array $products = [];
    public float $total = 0.00;
    protected $listeners = ['toggleBasket' => 'toggle',
        'basketUpdated' => 'hydrate'
    ];

    public function hydrate(): void
    {
        $this->basket = basket()->all();
        $this->products = tap(
            $this->products(),
            fn(Collection $product) => $this->total = int_to_decimal($product->sum('total'))
        )->ToArray();
    }

    public function toggle(): void
    {
        //jak false to true jak true to false
        $this->visible = !$this->visible;
    }

    public function remove(int $id): void
    {
        basket()->remove($id);
        $this->update();
    }

    private function update(): void
    {
        $this->emit('basketUpdated');
    }

    public function increase(int $id): void
    {
        basket()->add($id, $this->basket[$id] + 1);
        $this->update();
    }

    public function decrease(int $id): void
    {
        if (($qty = $this->basket[$id] - 1) < 1) {
            $this->remove($id);
        } else {
            basket()->add($id, $qty);
            $this->update();
        }
    }

    private function products(): Collection
    {
        if (empty($this->basket)) {
            return new Collection;
        }
        return Product::whereIn('id', array_keys($this->basket))
            ->get()
            ->map(function (Product $product) {
                return (object)[
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'formatted_price' => $product->formatted_price,
                    'qty' => $qty = $this->basket[$product->id],
                    'total' => $product->price * $qty,
                ];
            });
    }

    public function render()
    {
        return view('livewire.basket');
    }

}
