<?php

namespace App\View\Components\Auth;

use App\Models\SocialSetting;
use Illuminate\View\Component;

class SocialLogin extends Component
{
    public $social_setting;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->social_setting = SocialSetting::first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.auth.social-login');
    }
}
