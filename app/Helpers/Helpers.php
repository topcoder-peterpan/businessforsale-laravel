<?php

use App\Models\Theme;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\UserPlan;
use App\Models\ModuleSetting;
use Illuminate\Support\Facades\URL;
use Modules\Category\Entities\Category;
use Modules\Language\Entities\Language;
use Modules\Wishlist\Entities\Wishlist;
use App\Notifications\LoginNotification;

function setting()
{
    return Setting::first();
}

function languages()
{
    return Language::all();
}

/**
 * Check ad is wishlisted
 *
 * @param integer $adId
 * @return boolean
 */
function isWishlisted($adId)
{
    if (auth()->guard('customer')->check() && session()->has('wishlists') && in_array($adId, session('wishlists'))) {
        return true;
    }

    return false;
}

/**
 * Store customer plan information to session storage
 *
 * @return void
 */
function storePlanInformation()
{
    session()->forget('user_plan');
    session()->put('user_plan', auth()->guard('customer')->user()->userPlan);
}

function socialMediaShareLinks(string $path, string $subject)
{
    $base_url = URL::to('/');

    return [
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $base_url . $path . $subject,
        'twitter' => 'https://twitter.com/intent/tweet?text=' . $base_url . $path . $subject,
        'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $base_url . $path . $subject,
        'gmail' => 'https://mail.google.com/mail/u/0/?ui=2&fs=1&tf=cm&su=' . $base_url . $path . $subject,
        'whatsapp' => 'https://wa.me/?text=' . $base_url . $path . $subject
    ];
}


/**
 * Get is category menu selected
 *
 * @param Category $category
 *
 * @return boolean
 */
function isActiveCategorySidebar($category)
{
    $found = false;

    $categorySubcatategories = $category->subcategories->pluck('slug')->all();
    $urlSubCategories = request('subcategory', []);

    foreach ($categorySubcatategories as $category) {
        if (in_array($category, $urlSubCategories)) {
            $found  = true;
            break;
        }
    }

    return $found;
}


function homePageThemes()
{
    return Theme::first()->home_page;
}

function collectionToResource($data)
{
    return json_decode(json_encode($data), false);
}

/**
 * Store customer wishlists information to session storage
 *
 * @return void
 */
function resetSessionWishlist()
{
    session()->forget('wishlists');
    $wishlists =  Wishlist::select(['ad_id'])->where('customer_id', auth()->guard('customer')->id())->pluck('ad_id')->all();

    session()->put('wishlists', $wishlists);
}

/**
 * Send logged in notification
 *
 * @return void
 */
function loggedinNotification()
{
    $user = Customer::find(auth('customer')->id());
    $user->notify(new LoginNotification($user));
}

/**
 * customer has mambership badge or not
 *
 * @param int $customer_id
 * @return bool
 */
function hasMemberBadge($customer_id)
{
    return UserPlan::where('customer_id', $customer_id)->first()->badge;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function userCan($permission)
{
    if (auth('super_admin')->check()) {
        return auth('super_admin')->user()->can($permission);
    }

    return false;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function envReplace($name, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $name . '=' . env($name),
            $name . '=' . $value,
            file_get_contents($path)
        ));
    }
}

/**
 * Check module is enabled or not
 *
 * @param string $module_name
 * @return boolean
 */
function enableModule(string $module_name)
{
    try {
        return ModuleSetting::select($module_name)->first()->$module_name;
    } catch (\Exception $e) {
        return back()->with('error', 'Something went wrong!');
    }
}
