<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InformationSubsection extends Component
{
    public string $title;
    public string $id;

    /**
     * @param  string  $title
     * @param  string  $id
     */
    public function __construct(string $title, string $id)
    {
        $this->title = $title;
        $this->id    = $id;
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
        return view('components.information-subsection');
    }
}
