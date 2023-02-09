<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Gloudemans\Shoppingcart\CartItem as ShoppingcartItem;

class CheckoutItem extends Component
{
    public ShoppingcartItem $cartItem;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ShoppingcartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(): View|Factory|Application
    {
        return view('components.checkout-item');
    }
}
