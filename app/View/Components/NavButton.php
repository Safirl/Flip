<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class NavButton extends Component
{
    public string $icon;
    public string $label;
    public string $url;
    /**
     * Create a new component instance.
     */
    public function __construct(string $icon, string $label, string $url)
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-button');
    }
}
