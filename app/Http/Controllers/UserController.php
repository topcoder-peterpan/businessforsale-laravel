<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Models\Transaction;
use Modules\Ad\Entities\Ad;
use Modules\Blog\Entities\Post;
use App\Actions\User\CreateUser;
use App\Actions\User\UpdateUser;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserFormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;

class UserController extends Controller
{
    use ValidatesRequests;

    public function dashboard()
    {
        $data['customer'] = Customer::count();
        $data['adcount'] = Ad::count();
        $data['adcountActive'] = Ad::where('status', 'active')->count();
        // $data['adcountPending'] = Ad::where('status', 'pending')->count();
        $data['adcountExpired'] = Ad::where('status', 'expired')->count();
        $data['adcountFeatured'] = Ad::where('featured', 1)->count();
        $data['cityCount'] = City::count();
        $data['townCount'] = Town::count();
        $data['blogpostCount'] = Post::count();

        // bar chart by year
        $transactions = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        for ($i = 0; $i < 12; $i++) {
            $transactions[$i] = (int)Transaction::select('amount')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i + 1)
                ->sum('amount');
        }
        $data['transactionData'] = $transactions;

        $data['latestAds'] = Ad::select(['id', 'slug', 'price', 'status', 'title'])->orderBy('id', 'DESC')->limit(10)->get();
        $data['latestusers'] = Customer::select(['id', 'name', 'email', 'created_at',])->orderBy('id', 'DESC')->limit(10)->get();

        $data['latestTransactionUsers'] = Transaction::with(['customer:id,name,email', 'plan:id,label,price'])->limit(10)->get();

        $data['topLocation'] = City::select(['id', 'name',])->withCount('ads')->orderBy('ads_count', 'DESC')->limit(10)->get();

        return view('backend.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('admin.view')) {
            return abort(403);
        }
        $users = SuperAdmin::where('id', '!=', 1)->SimplePaginate(10);
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('admin.create')) {
            return abort(403);
        }
        $roles = Role::all();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        if (!userCan('admin.create')) {
            return abort(403);
        }

        try {
            CreateUser::create($request);

            flashSuccess('User Created Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SuperAdmin $user)
    {
        if (!userCan('admin.update')) {
            return abort(403);
        }

        $roles = Role::all();
        return view('backend.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, SuperAdmin $user)
    {
        if (!userCan('admin.update')) {
            return abort(403);
        }

        try {
            UpdateUser::update($request, $user);

            flashSuccess('User Updated Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperAdmin $user)
    {
        if (!userCan('admin.delete')) {
            return abort(403);
        }

        try {
            if (!is_null($user)) {
                $user->delete();
            }

            flashSuccess('User Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }
}
