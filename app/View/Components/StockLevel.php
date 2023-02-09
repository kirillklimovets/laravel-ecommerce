<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StockLevel extends Component
{
    public int $productQuantity;

    public const HIGH = 'В наличии';

    public const LOW = 'Осталось мало';

    public const NONE = 'Товар закончился';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $productQuantity)
    {
        $this->productQuantity = $productQuantity;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|string|Closure
    {
        if ($this->productQuantity > setting('site.stock_threshold', 5)) {
            $level = self::HIGH;
        } elseif ($this->productQuantity > 0) {
            $level = self::LOW;
        } else {
            $level = self::NONE;
        }

        return view('components.stock-level', compact('level'));
    }
}
