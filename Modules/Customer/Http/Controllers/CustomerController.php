<?php

namespace Modules\Customer\Http\Controllers;

use App\Models\Customer;
use App\Models\UserPlan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('customer.view')) {
            return abort(403);
        }
        $query = Customer::query();
        if (request()->has('keyword') && request()->keyword != null) {
            $keyword = request('keyword');
            $query->where('name', "LIKE", "%$keyword%")
                ->orWhere('username', "LIKE", "%$keyword%")
                ->orWhere('email', "LIKE", "%$keyword%");
        }

        if (request()->has('type') && request()->type == 'pro') {
            $query->whereHas('userPlan', function ($q) {
                $q->where('badge', 1);
            });
        }


        $customers = $query->with('userPlan')->get();

        return view('customer::index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Customer $customer)
    {
        return view('customer::show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('customer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
