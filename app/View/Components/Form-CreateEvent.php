<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCreateEvent extends Component
{
    /**
     * Create a new component instance.
     */
        public $action;
        public $method;

    public function __construct($action = '#', $method = 'POST')
    {
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form--create-event');
    }
}
