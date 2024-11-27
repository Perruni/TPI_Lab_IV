<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryFilterFormMostrarEventos extends Component
{
    public $categorias;

    public function __construct($categorias)
    {
        $this->categorias = $categorias;
    }

    public function render()
    {
        return view('components.category-filter-form-mostrar-eventos');
    }
}
