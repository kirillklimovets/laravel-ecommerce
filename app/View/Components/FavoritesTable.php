<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavoritesTable extends Component
{
    public string $title;
    public string $cartInstanceName;

    /**
     * @param  string  $title
     * @param  string  $cartInstanceName
     */
    public function __construct(string $title, string $cartInstanceName)
    {
        $this->title            = $title;
        $this->cartInstanceName = $cartInstanceName;
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
     */
    public function render(): View|Closure|string
    {
        return view('components.favorites-table');
    }
}
