<?php

namespace App\View\Components\errors;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertError extends Component
{
    /**
     * Create a new component instance.
     */

    public $error;
    
    public function __construct($error)
    {
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.errors.alert-error');
    }
}
