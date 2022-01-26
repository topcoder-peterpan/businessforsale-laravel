<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class SingleAd extends Component
{
    public $ad;
    public $className;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ad, $className)
    {
        $this->ad = $ad;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.single-ad');
    }
}
