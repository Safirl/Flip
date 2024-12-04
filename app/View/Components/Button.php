<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $size;
    public $color;
    public $outlined;
    public $iconStart;
    public $iconEnd;
    public $label;
    public $onClick;
    public $expand;

    public function __construct(
        $size = 'large',
        $color = 'primary',
        $outlined = false,
        $iconStart = null,
        $iconEnd = null,
        $label = 'Label',
        $onClick = null,
        $expand = false
    ) {
        $this->size = $size;
        $this->color = $color;
        $this->outlined = $outlined;
        $this->iconStart = $iconStart;
        $this->iconEnd = $iconEnd;
        $this->label = $label;
        $this->onClick = $onClick;
        $this->expand = $expand;
    }

    public function sizeClass()
    {
        $sizes = [
            'small' => 'btn-size-small',
            'medium' => 'btn-size-medium',
            'large' => 'btn-size-large',
        ];

        return $sizes[$this->size] ?? $sizes['large'];
    }

    public function colorClass()
    {
        $classes = [
            'white' => 'btn-fill-white',
            'primary' => 'btn-fill-primary',
            'secondary' => 'btn-fill-secondary',
            'grey' => 'btn-fill-grey',
            'error' => 'btn-fill-error',
        ];

        return $classes[$this->color] ?? $classes['primary'];
    }

    public function outlinedClass()
    {
        return $this->outlined ? 'btn-outlined' : '';
    }

    public function expandClass()
    {
        return $this->expand ? 'btn-expand' : '';
    }

    public function render()
    {
        return view('components.button');
    }
}
