<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResetButton extends Component
{
    /**
     * Create a new component instance.
     */

    public $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.reset-button');
    }
}
