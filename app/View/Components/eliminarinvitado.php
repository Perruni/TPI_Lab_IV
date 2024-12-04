<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Eliminarinvitado extends Component
{
    /**
     * Create a new component instance.
     */
    public $permiso;
    public $eliminarInvitado;

    public function __construct($permiso, $eliminarInvitado)
    {
        $this->permiso = $permiso;
        $this->eliminarInvitado = $eliminarInvitado;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.eliminarinvitado');
    }
}
