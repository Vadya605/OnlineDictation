<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    /**
     * Create a new component instance.
     */

    public $inputPlaceholder;
    
    public function __construct($inputPlaceholder)
    {
        $this->inputPlaceholder = $inputPlaceholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search');
    }
}
