<?php

namespace App\View\Components\Arrows;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArrowDown extends Component
{
    /**
     * Create a new component instance.
     */

    public $sortValue;

    public function __construct($sortValue)
    {
        $this->sortValue = $sortValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.arrows.arrow-down');
    }
}
