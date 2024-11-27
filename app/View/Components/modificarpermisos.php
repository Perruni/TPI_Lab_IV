<?php
namespace App\View\Components;

use Illuminate\View\Component;

class ModificarPermisos extends Component
{
    public $invitadoId;
    public $eventId;
    public $permiso;

    public function __construct($invitadoId, $eventId, $permiso)
    {
        $this->invitadoId = $invitadoId;
        $this->eventId = $eventId;
        $this->permiso = $permiso;
    }

    public function render()
    {
        return view('components.modificarpermisos');
    }
}