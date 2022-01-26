<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdCustomerInfo extends Component
{
    public $customer, $town, $city, $link;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($customer, $town, $city, $link)
    {
        $this->customer = $customer;
        $this->town = $town;
        $this->city = $city;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-customer-info');
    }
}
