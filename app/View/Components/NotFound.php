<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotFound extends Component
{
    public $word, $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $word = 'User', string $route = null)
    {
        $this->word = $word;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.not-found');
    }
}
