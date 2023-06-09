<?php

namespace App\View\Components\Messages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageSuccess extends Component
{
    /**
     * Create a new component instance.
     */

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.message-success');
    }
}
