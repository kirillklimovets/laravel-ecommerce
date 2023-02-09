<?php

namespace App\View\Components;

use Gloudemans\Shoppingcart\CartItem as ShoppingcartItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavoritesItem extends Component
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(): View|Factory|Application
    {
        return view('components.favorites-item');
    }
}
