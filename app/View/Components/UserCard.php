<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserCard extends Component
{
    public $image;
    public $label;
    public $text;
    public $imageColor;
    public $isBackground;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $image = null,
        $label = null,
        $text = null,
        $imageColor = null,
        $isBackground = true
    )
    {
        $this->image = $image;
        $this->label = $label;
        $this->text = $text;
        $this->imageColor = $imageColor;
        $this->isBackground = filter_var($isBackground, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-card');
    }
}
