<?php
namespace App\View\Components;

use Illuminate\View\Component;

class modificarpermisos extends Component
{
    public $invitadoId;
    public $eventId;

    public function __construct($invitadoId, $eventId)
    {
        $this->invitadoId = $invitadoId;
        $this->eventId = $eventId;
    }

    public function render()
    {
        return view('components.modificarpermisos');
    }
}
