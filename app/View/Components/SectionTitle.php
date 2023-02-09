<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionTitle extends Component
{
    public ?string $title;
    public bool $withDivider;
    public int $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $title, int $size = 3, bool $withDivider = true)
    {
        $this->title       = $title;
        $this->size        = $size;
        $this->withDivider = $withDivider;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.section-title');
    }
}
