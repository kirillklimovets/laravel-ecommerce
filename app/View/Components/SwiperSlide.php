<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SwiperSlide extends Component
{
    public string $image;
    public string $alt;
    public bool $isThumb;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $image, string $alt, bool $isThumb = false)
    {
        $this->image   = $image;
        $this->alt     = $alt;
        $this->isThumb = $isThumb;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.swiper-slide');
    }
}
