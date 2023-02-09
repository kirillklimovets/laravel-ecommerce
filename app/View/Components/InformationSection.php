<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InformationSection extends Component
{
    public string $title;
    public string $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $id)
    {
        $this->title = $title;
        $this->id    = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.information-section');
    }
}
