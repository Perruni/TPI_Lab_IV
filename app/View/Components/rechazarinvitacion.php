<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class rechazarinvitacion extends Component
{
    /**
     * Create a new component instance.
     */
    public $invitacionId;

    public function __construct($invitacionId)
    {
        $this->invitacionId = $invitacionId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rechazarinvitacion');
    }
}
