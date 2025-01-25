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

    public $classes;

    public $type;

    public function __construct(
        $size = '',
        $color = '',
        $kind = '',
        $iconStart = null,
        $iconEnd = null,
        $label = '',
        $onClick = null,
        $expand = false,
        $classes = null
    ) {
        $this->size = $size;
        $this->color = $color;
        $this->kind = $kind;
        $this->iconStart = $iconStart;
        $this->iconEnd = $iconEnd;
        $this->label = $label;
        $this->onClick = $onClick;
        $this->expand = $expand;
        $this->classes = $classes;
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

    public function kindClass()
    {
        $kinds = [
            'filled' => '',
            'outlined' => 'btn-outlined',
            'clear' => 'btn-clear',
        ];

        return $kinds[$this->kind] ?? '';
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
