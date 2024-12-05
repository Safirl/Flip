<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public $size;
    public $color;
    public $iconStart;
    public $iconEnd;
    public $url;
    public $route;
    public $label;
    public $noPadding;

    public function __construct(
        $size = 'medium',
        $color = 'primary',
        $iconStart = null,
        $iconEnd = null,
        $url = '',
        $route = '',
        $label = 'Link',
        $noPadding = false
    )
    {
        $this->size = $size;
        $this->color = $color;
        $this->iconStart = $iconStart;
        $this->iconEnd = $iconEnd;
        $this->url = $url;
        $this->route = $route;
        $this->label = $label;
        $this->noPadding = $noPadding;
    }

    public function sizeClass()
    {
        $sizes = [
            'small' => 'link-size-small',
            'medium' => 'link-size-medium',
            'large' => 'link-size-large',
        ];

        return $sizes[$this->size] ?? $sizes['medium'];
    }

    public function colorClass()
    {
        $colors = [
            'primary' => 'link-primary',
            'secondary' => 'link-secondary',
        ];

        return $colors[$this->color] ?? $colors['primary'];
    }

    public function noPaddingClass()
    {
        return $this->noPadding ? 'link-noPadding' : '';
    }

    public function render()
    {
        return view('components.link');
    }
}
