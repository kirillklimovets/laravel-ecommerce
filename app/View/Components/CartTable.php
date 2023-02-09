<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartTable extends Component
{
    public string $cartInstanceName;
    public string $title;

    /**
     * @param  string  $cartInstanceName
     * @param  string  $title
     */
    public function __construct(string $cartInstanceName, string $title)
    {
        $this->cartInstanceName = $cartInstanceName;
        $this->title            = $title;
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function render(): View|Closure|string
    {
        $priceInfo = getTotalPriceInformation();

        return view('components.cart-table', [
            ...$priceInfo->only('discount', 'newSubtotal', 'newTax', 'newTotal')->toArray(),
        ]);
    }
}
