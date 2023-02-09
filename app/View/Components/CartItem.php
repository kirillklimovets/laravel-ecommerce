<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Gloudemans\Shoppingcart\CartItem as ShoppingcartItem;

class CartItem extends Component
{
    public ShoppingcartItem $cartItem;

    /**
     * @param  \Gloudemans\Shoppingcart\CartItem  $cartItem
     */
    public function __construct(ShoppingcartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }
    /**
     * Create a new component instance.
     *
     * @return void
     */

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Factory|Application
    {
        return view('components.cart-item');
    }
}
