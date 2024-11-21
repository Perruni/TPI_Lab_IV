<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArrowButton extends Component
{
    public $href;

    public function __construct($href = '/fullcalendar')
    {
        $this->href = $href;
    }

    public function render()
    {
        return view('components.arrow-button');
    }
}
