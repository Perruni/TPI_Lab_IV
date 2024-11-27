<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryFilterForm extends Component
{
    public $categoria;

    public function __construct($categoria)
    {
        $this->categoria = $categoria;
    }

    public function render()
    {
        return view('components.category-filter-form');
    }
}
