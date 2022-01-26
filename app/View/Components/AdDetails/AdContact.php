<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdContact extends Component
{
    public $phone, $name;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($phone, $name)
    {
        $this->phone = $phone;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-contact');
    }
}
