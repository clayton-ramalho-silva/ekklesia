<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonDesassociarVaga extends Component
{

    public $resume;
    /**
     * Create a new component instance.
     */
    public function __construct($resume)
    {
        $this->resume = $resume;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-desassociar-vaga');
    }
}
