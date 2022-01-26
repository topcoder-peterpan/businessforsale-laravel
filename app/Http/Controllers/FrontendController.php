<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Theme;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\BlogComment;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use Modules\Tag\Entities\Tag;
use App\Models\PaymentSetting;
use Modules\Blog\Entities\Post;
use Modules\Plan\Entities\Plan;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Faq\Entities\FaqCategory;
use Modules\Ad\Transformers\AdResource;
use Modules\Category\Entities\Category;
use App\Notifications\LogoutNotification;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Category\Transformers\CategoryResource;

class FrontendController extends Controller
{
    /**
     * View Home page
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function index()
    {
        $data = [];
        $topCategories = CategoryResource::collection(Category::with('subcategories')->withCount('ads as ad_count')->latest('ad_count')->take(8)->get());
        $home_page = Theme::first()->home_page;
        $topCities = City::withCount('ads as ad_count')->latest('ad_count')->take(6)->get();

        $data['topCategories'] = collectionToResource($topCategories);
        $data['topCities'] = $topCities;
        $data['totalAds'] = Ad::where('status', '!=', 'expired')->count();

        if ($home_page == 1) {
            return $this->homePage1($data);
        } elseif ($home_page == 2) {
            return $this->homePage2($data);
        } else {
            return $this->homePage3($data);
        }
    }


    /**
     * Return homapge 1 layouts views
     *
     * @param array $data
     *
     * @return View
     */
    public function homePage1($data)
    {
        $ad_data = Ad::with(['customer', 'city', 'category:id,name,icon'])->where('status', '!=', 'expired');
        $ads = AdResource::collection($ad_data->get());
        $categories = CategoryResource::collection(Category::with('subcategories')->get());
        $recommendedAds = AdResource::collection($ad_data->where('featured', true)->take(12)->latest()->get());

        $data['ads'] = collectionToResource($ads);
        $data['categories'] = collectionToResource($categories);
        $data['recommendedAds'] = collectionToResource($recommendedAds);

        $data['verified_users'] = Customer::whereNotNull('email_verified_at')->count();
        $data['city_count'] = City::count();

        $data['pro_members_count'] = Customer::whereHas('userPlan', function ($q) {
            $q->where('badge', true);
        })->count();


        // return $data;

        return view('frontend.index', $data);
    }


    /**
     * Return homepage 2 layouts views
     *
     * @param Array $data
     *
     * @return View
     */
    public function homePage2($data)
    {
        $categories = CategoryResource::collection(Category::withCount('ads as ad_count')->latest()->get());
        $recentads = AdResource::collection(Ad::with('category', 'customer', 'city')->where('status', '!=', 'expired')->latest('id')->get()->take(4));
        $featured_ad_data = Ad::with(['customer', 'city', 'category:id,name,icon',])->where('status', '!=', 'expired')->take(6)->latest()->get();
        $featuredad = AdResource::collection($featured_ad_data);

        $data['categories'] = collectionToResource($categories);
        $data['featuredAds'] = collectionToResource($featuredad);
        $data['recentads'] = $recentads;
        $data['towns'] = Town::orderBy('name')->get();

        return view('frontend.index_02', $data);
    }

    /**
     * Return homepage 3 layouts views
     *
     * @param Array $data
     * @return View
     */
    public function homePage3($data)
    {
        $recentads = AdResource::collection(Ad::with('category', 'city')->where('status', '!=', 'expired')->latest('total_views')->get()->take(8));
        $categories = CategoryResource::collection(Category::latest()->get());
        $plans = Plan::all();
        $ad_data = Ad::with(['category', 'customer', 'city'])->where('status', '!=', 'expired')->take(6)->latest()->get();
        $newestAds = AdResource::collection($ad_data);
        $data['categories']  =  collectionToResource($categories);
        $data['towns']  = Town::orderBy('name')->get();
        $data['recentads']  = collectionToResource($recentads);
        $data['newestAds']  = collectionToResource($newestAds);
        $data['plans']  = $plans;

        return view('frontend.index_03', $data);
    }


    /**
     * View Testimonial page
     *
     * @param  Testimonial
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function about()
    {
        $testimonials = Testimonial::latest('id')->get();
        $cms = Cms::select(['about_body', 'about_video_thumb'])->first();
        return view('frontend.about', compact('testimonials', 'cms'));
    }

    /**
     * View Faq page
     *
     *  @param  Faq
     * @return void
     */
    public function faq()
    {
        if (!enableModule('faq')) {
            abort(404);
        }
        $category_slug = request('category') ?? FaqCategory::first()->slug;
        $category = FaqCategory::where('slug', $category_slug)->first();
        $data['categories'] = FaqCategory::latest()->get(['id', 'name', 'slug', 'icon']);
        $data['faqs'] = Faq::where('faq_category_id', $category->id)->with('faq_category:id,name,icon')->get();

        return view("frontend.faq", $data);
    }

    /**
     * View Contact page
     *
     * @return void
     */
    public function contact()
    {
        if (!enableModule('contact')) {
            abort(404);
        }
        return view('frontend.contact');
    }

    /**
     * View Single Ad page
     *
     * @return void
     */
    public function adDetails(Ad $ad)
    {
        // return $ad;
        $ad->increment('total_views');
        $ad = $ad->load(['customer', 'brand', 'adFeatures', 'galleries', 'town', 'city']);

        $lists = AdResource::collection(Ad::select(['id', 'title', 'slug', 'price', 'thumbnail', 'category_id', 'city_id'])
            ->with(['city', 'category'])
            ->where('category_id', $ad->category_id)
            ->where('id', '!=', $ad->id)
            ->where('status', '!=', 'expired')
            ->latest('id')->take(10)->get());

        if ($ad->status === 'expired' && $ad->customer->id !== auth('customer')->id()) {
            return abort(404);
        } else {
            return view('frontend.single-ad', compact('ad', 'lists'));
        }
    }

    /**
     * View ad list page
     *
     * @return void
     */
    public function adList()
    {
        $data['adlistings'] = Ad::with(['category', 'city'])->latest('id')->where('status', '!=', 'expired')->paginate(21);
        $data['categories'] = Category::with('subcategories')->latest('id')->get();
        $data['cities'] = City::latest()->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['adMaxPrice'] = $price = \DB::table('ads')->max('price');

        return view('frontend.ad-list', $data);
    }

    /**
     * View Get membership page
     *
     * @return void
     */
    public function getMembership()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $data['plans'] = Plan::latest()->get();
        return view('frontend.get-membership', $data);
    }

    /**
     * View Priceplan page
     *
     * @return void
     */
    public function pricePlan()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $data['plans'] = Plan::all();
        return view('frontend.price-plan', $data);
    }

    /**
     * View Signup page
     *
     * @return void
     */
    public function signUp()
    {
        return view('frontend.sign-up');
    }

    /**
     * Show the form for creating a new resource.
     * @param  Customer
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'username' => "required|unique:customers,username",
            'email' => "required|email|unique:customers,email",
            'password' => "required|confirmed|min:8|max:50",
        ]);

        $created = Customer::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($created) {
            Auth::guard('customer')->logout();
            flashSuccess('Registration Successful!');
            return redirect()->route('customer.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function frontendLogout()
    {
        $this->loggedoutNotification();
        auth()->guard('customer')->logout();

        return redirect()->route('customer.login');
    }

    public function loggedoutNotification()
    {
        // Send login notification
        $user = Customer::find(auth('customer')->id());
        $user->notify(new LogoutNotification($user));
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function blog(Request $request)
    {
        if (!enableModule('blog')) {
            abort(404);
        }

        $query = Post::with('author')->withCount('comments');

        if ($request->has('category') && $request->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        return view('frontend.blog', [
            'blogs' =>  $query->paginate(6)->withQueryString(),
            'recentBlogs' => Post::withCount('comments')->latest()->take(4)->get(),
            'topCategories' => Category::latest()->take(6)->get(),
            'popularTags' => Tag::latest()->take(6)->get(['name', 'slug',]),
        ]);
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function singleBlog(Post $blog)
    {
        if (!enableModule('blog')) {
            abort(404);
        }

        $recentPost =  Post::withCount('comments')->latest('id')->take(6)->get();
        $tags = Tag::latest()->take(6)->get();
        $categories = Category::latest()->take(6)->get();
        $blog->load('author', 'category')->loadCount('comments');

        return view('frontend.blog-single', compact('blog', 'categories', 'recentPost', 'tags'));
    }


    /**
     * View Privacy Policy page
     *
     * @return void
     */
    public function privacy()
    {
        return view('frontend.privacy')->withCms(Cms::select(['privacy_body', 'privacy_background'])->first());
    }


    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function terms()
    {
        return view('frontend.terms')->withCms(Cms::select(['terms_body', 'terms_background'])->first());
    }

    /**
     *
     * @param int $post_id
     * @return array
     */
    public function commentsCount($post_id)
    {
        return BlogComment::where('post_id', $post_id)->count();
    }

    /**
     *
     * @param int $post_id
     * @return array
     */
    public function pricePlanDetails($plan_label)
    {
        if (!auth('customer')->check()) {
            abort(404);
        }

        $plan = Plan::where('label', $plan_label)->first();
        $payment_setting = PaymentSetting::first();
        return view('frontend.plan-details', compact('plan', 'payment_setting'));
    }



    public function adGalleryDetails(Ad $ad)
    {
        $ad->load('galleries');
        return view('frontend.single-ad-gallery', compact('ad'));
    }
}
