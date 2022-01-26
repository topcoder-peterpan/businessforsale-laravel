<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('auth.customer.dashboard');
    }
}
