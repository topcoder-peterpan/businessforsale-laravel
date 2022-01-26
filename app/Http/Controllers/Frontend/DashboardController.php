<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use App\Models\UserPlan;
use App\Models\Transaction;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Frontend\ProfileUpdate;
use App\Models\Setting;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use App\Notifications\AdDeleteNotification;
use App\Notifications\AdWishlistNotification;
use App\Rules\MatchOldPassword;

class DashboardController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $authUser = auth('customer')->user();
        $ads = Ad::customerData()->get();
        $activities = auth('customer')->user()->notifications()->latest()->limit(5)->get();
        $recent_ads = Ad::customerData()->with('category')->latest('id')->get()->take(10);
        $favourite_count = Wishlist::whereCustomerId($authUser->id)->count();
        $posted_ads_count = $ads->where('customer_id', $authUser->id)->count();
        $expire_ads_count = $ads->where('status', 'expired')->where('customer_id', $authUser->id)->count();

        // bar chart by year
        $bar_chart_datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        for ($i = 0; $i < 12; $i++) {
            $bar_chart_datas[$i] = (int)Ad::customerData()
                ->select('total_views')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i + 1)
                ->sum('total_views');
        }

        return view('frontend.dashboard', [
            'activities' =>  $activities,
            'recent_ads' =>  $recent_ads,
            'favouriteadcount' =>  $favourite_count,
            'posted_ads_count' =>  $posted_ads_count,
            'expire_ads_count' =>  $expire_ads_count,
            'bar_chart_datas' =>  $bar_chart_datas,
        ]);
    }

    public function editAd(Ad $ad)
    {
        $data['user'] = auth()->user();
        $data['ad'] = $ad;
        return view('frontend.edit-ad', $data);
    }

    public function myAds()
    {
        $data['categories'] = Category::all();
        $data['user'] = auth('customer')->user();

        $query =  Ad::customerData();

        if (request()->has('keyword') && request()->keyword != null) {
            $keyword = request('keyword');
            $query->where('title', 'LIKE', "%$keyword%");
        }

        if (request()->has('category') && request()->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if (request()->has('sort_by') && request()->sort_by != null && request('sort_by') == 'oldest') {
            $query->orderBy('id', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $data['ads'] = $query->paginate(5)->withQueryString();

        return view('frontend.myad', $data);
    }

    public function deleteMyAd(Ad $ad)
    {
        $ad->delete();

        flashSuccess('One of your ad has deleted');
        $this->addeleteNotification();
        return back();
    }

    public function addeleteNotification()
    {
        // Send ad create notification
        $user = auth('customer')->user();
        $user->notify(new AdDeleteNotification($user));
    }

    public function myAdStatus(Ad $ad)
    {
        if ($ad->status == 'active') {
            $ad->status = 'expired';
        } elseif (($ad->status == 'expired')) {
            $ad->status = 'active';
        }
        $ad->update();

        flashSuccess('Status updated successfully!');
        return back();
    }

    public function favourites()
    {
        $wishlistsIds = Wishlist::select('ad_id')
            ->customerData()
            ->pluck('ad_id')
            ->all();


        $query = Ad::select(['id', 'title', 'slug', 'thumbnail', 'price', 'status', 'category_id', 'created_at'])
            ->with('category:id,name')
            ->whereIn('id', $wishlistsIds);

        if (request()->has('keyword') && request()->keyword != null) {
            $keyword = request('keyword');
            $query->where('title', 'LIKE', "%$keyword%");
        }

        if (request()->has('category') && request()->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if (request()->has('sort_by') && request()->sort_by != null && request('sort_by') == 'oldest') {
            $query->orderBy('id', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $data['wishlists'] = $query->paginate(5)->withQueryString();

        return view('frontend.favourite-ads', $data);
    }

    public function message()
    {
        $user['user'] = auth()->user();
        return view('frontend.message', $user);
    }

    public function plansBilling()
    {
        $data['plan_info'] = UserPlan::customerData()->firstOrFail();
        $data['transactions'] = Transaction::with('plan')->customerData()->latest()->get()->take(5);
        // return $data['transactions'] = Transaction::where('customer_id', auth('customer')->id())->latest()->get()->take(5);
        // $user['user'] = auth()->user();
        return view('frontend.plans-billing', $data);
    }

    public function accountSetting()
    {
        $user['user'] = auth('customer')->user();
        return view('frontend.account-setting', $user);
    }

    public function profileUpdate(Request $request)
    {
        $customer = auth('customer')->user();

        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:customers,email,{$customer->id}",
            'phone' => "sometimes|nullable|unique:customers,phone,{$customer->id}",
            'web' => "sometimes|nullable|url|unique:customers,web,{$customer->id}",
        ]);

        try {
            $customer = ProfileUpdate::update($request, $customer);

            if ($customer) {
                flashSuccess('Profile Updated Successfully');
                return back();
            }
        } catch (\Exception $e) {
            flashError();
            return back();
        }
    }

    public function passwordUpdate(Request $request)
    {
        // validation
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $password_check = Hash::check($request->current_password, auth('customer')->user()->password);

        if ($password_check) {
            $user = Customer::findOrFail(auth('customer')->id());
            $user->update([
                'password' => bcrypt($request->password),
                'updated_at' => Carbon::now(),
            ]);

            flashSuccess('Password Updated Successfully');
            return back();
        } else {
            flashError('Something went wrong');
            return back();
        }
    }

    public function addToWishlist(Request $request)
    {
        $ad = Ad::findOrFail($request->ad_id);
        $data = Wishlist::where('ad_id', $request->ad_id)->whereCustomerId($request->customer_id)->first();
        if ($data) {
            $data->delete();

            $user = auth('customer')->user();
            $user->notify(new AdWishlistNotification($user, 'remove', $ad->slug));
            flashSuccess('Ad removed from wishlist');
        } else {
            Wishlist::create([
                'ad_id' => $request->ad_id,
                'customer_id' => $request->customer_id
            ]);

            $user = auth('customer')->user();
            $user->notify(new AdWishlistNotification($user, 'add', $ad->slug));
            flashSuccess('Ad added to wishlist');
        }
        resetSessionWishlist();

        return back();
    }

    public function deleteAccount(Customer $customer)
    {
        $customer->delete();
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }


    /**
     * Update ad status to expire
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function markExpired(Ad $ad)
    {
        $ad->update([
            'status'    =>  'expired'
        ]);

        flashSuccess('Status updated successfully!');
        return back();
    }

    /**
     * Update ad status to expire
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function markActive(Ad $ad)
    {
        $ad->update([
            'status' => 'active'
        ]);

        flashSuccess('Status updated successfully!');
        return back();
    }

    /**
     * View Post Rules Page
     *
     * @return View
     */
    public function postRules()
    {
        return view('frontend.posting-rules')->withSetting(Setting::first());
    }
}
