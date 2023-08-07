<?php

namespace App\View\Components\buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $textBtn;

    public function __construct($textBtn)
    {
        $this->textBtn = $textBtn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.create-button');
    }
}
