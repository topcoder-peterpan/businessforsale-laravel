<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;

class CmsSettingController extends Controller
{


    /**
     * Update posting rules text
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postingRulesUpdate(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms =  Cms::first();
        if($request->hasFile('posting_rules_background')){
            $request->validate([
                'posting_rules_background'    =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);
            deleteImage($cms->posting_rules_background);
            $url = uploadImage($request->posting_rules_background, 'banners');
            $cms->update($request->only('posting_rules_body') + ['posting_rules_background'=>$url]);

        }else{
            $request->validate([
                'posting_rules_body'    =>  ['required']
            ]);
            $cms->update($request->only('posting_rules_body'));
        }

        return redirect()->back()->with('success', 'Posting rules update successfully!');
    }

    /**
     * About information update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateAbout(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms =  Cms::first();
        $rules = [ 'about_body'    =>  ['required']];
        $data = $request->only('about_body');


        if($request->hasFile('about_video_thumb')){
            $rules['about_video_thumb'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('about_background')){
            $rules['about_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }

        if($request->hasFile('about_video_thumb')){
            deleteImage($cms->about_video_thumb);
            $data['about_video_thumb'] =  uploadImage($request->about_video_thumb, 'banners');
        }
        if($request->hasFile('about_background')){
            deleteImage($cms->about_background);
            $data['about_background'] =  uploadImage($request->about_background, 'banners');
        }


        return $data;
        $request->validate($rules);
        $cms->update($data);

        return redirect()->back()->with('success', 'About update successfully!');
    }

    /**
     * Terms information update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateTerms(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms = Cms::first();

        if($request->hasFile('terms_background')){
            $request->validate([
                'terms_background'    =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);
            deleteImage($cms->terms_background);
            $url = uploadImage($request->terms_background, 'banners');
            $cms->update($request->only('terms_body') + ['terms_background'=>$url]);

        }else{
            $request->validate([
                'terms_body'    =>  ['required']
            ]);
            $cms->update($request->only('terms_body'));
        }

        return redirect()->back()->with('success', 'Term & Condition update successfully!');
    }

    /**
     * privacy information update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePrivacy(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms =  Cms::first();
        if($request->hasFile('privacy_background')){
            $request->validate([
                'privacy_background'    =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);
            deleteImage($cms->privacy_background);
            $url = uploadImage($request->privacy_background, 'banners');
            $cms->update($request->only('privacy_body') + ['privacy_background'=>$url]);

        }else{
            $request->validate([
                'privacy_body'    =>  ['required']
            ]);
            $cms->update($request->only('privacy_body'));
        }

        return redirect()->back()->with('success', 'Privacy Policy update successfully!');
    }


    /**
     * Update Home page static images
     *
     * @@author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateHome(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms =  Cms::first();
        $rules = [];
        $data = [];


        if($request->hasFile('index1_main_banner')){
            $rules['index1_main_banner'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('index1_counter_background')){
            $rules['index1_counter_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('index1_mobile_app_banner')){
            $rules['index1_mobile_app_banner'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('index2_search_filter_background')){
            $rules['index2_search_filter_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('index2_get_membership_background')){
            $rules['index2_get_membership_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('index3_search_filter_background')){
            $rules['index3_search_filter_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }




        if($request->hasFile('index1_main_banner')){
            deleteImage($cms->index1_main_banner);
            $data['index1_main_banner'] =  uploadImage($request->index1_main_banner, 'banners');
        }
        if($request->hasFile('index1_counter_background')){
            deleteImage($cms->index1_counter_background);
            $data['index1_counter_background'] =  uploadImage($request->index1_counter_background, 'banners');
        }
        if($request->hasFile('index1_mobile_app_banner')){
            deleteImage($cms->index1_mobile_app_banner);
            $data['index1_mobile_app_banner'] =  uploadImage($request->index1_mobile_app_banner, 'banners');
        }
        if($request->hasFile('index2_search_filter_background')){
            deleteImage($cms->index2_search_filter_background);
            $data['index2_search_filter_background'] =  uploadImage($request->index2_search_filter_background, 'banners');
        }
        if($request->hasFile('index2_get_membership_background')){
            deleteImage($cms->index2_get_membership_background);
            $data['index2_get_membership_background'] =  uploadImage($request->index2_get_membership_background, 'banners');
        }
        if($request->hasFile('index3_search_filter_background')){
            deleteImage($cms->index3_search_filter_background);
            $data['index3_search_filter_background'] =  uploadImage($request->index3_search_filter_background, 'banners');
        }

        $request->validate($rules);
        $cms->update($data);

        return redirect()->back()->with('success', 'Home Settings update successfully!');
    }




    /**
     * Update Get Membership Page static images
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateGetMembership(Request $request)
    {

        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms =  Cms::first();
        $rules = [];
        $data = [];

        if($request->hasFile('get_membership_background')){
            $rules['get_membership_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('get_membership_image')){
            $rules['get_membership_image'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }

        if($request->hasFile('get_membership_background')){
            deleteImage($cms->get_membership_background);
            $data['get_membership_background'] =  uploadImage($request->get_membership_background, 'banners');
        }
        if($request->hasFile('get_membership_image')){
            deleteImage($cms->get_membership_image);
            $data['get_membership_image'] =  uploadImage($request->get_membership_image, 'banners');
        }

        $request->validate($rules);
        $cms->update($data);

        return redirect()->back()->with('success', 'Get Membership Settings update successfully!');
    }



    /**
     * Update Pricing Plan Static Images
     *
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updatePricingPlan(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        if($request->hasFile('pricing_plan_background')){
            $request->validate([
                'pricing_plan_background' =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);

            $cms =  Cms::first();
            deleteImage($cms->pricing_plan_background);
            $url =  uploadImage($request->pricing_plan_background, 'banners');
            $cms->update(['pricing_plan_background'=> $url]);
        }

        return redirect()->back()->with('success', 'Pricing Plan Settings update successfully!');
    }


    /**
     * Update Faqs static Images
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function updateFaq(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        if($request->hasFile('faq_background')){
            $request->validate([
                'faq_background' =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);

            $cms =  Cms::first();
            deleteImage($cms->faq_background);
            $url =  uploadImage($request->faq_background, 'banners');
            $cms->update(['faq_background'=> $url]);
        }

        return redirect()->back()->with('success', 'Faqs Settings update successfully!');
    }

    /**
     * Update DAshboard static Images
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function updateDashboard(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $cms =  Cms::first();
        $rules = [];
        $data = [];


        if($request->hasFile('dashboard_overview_background')){
            $rules['dashboard_overview_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('dashboard_post_ads_background')){
            $rules['dashboard_post_ads_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }

        if($request->hasFile('dashboard_my_ads_background')){
            $rules['dashboard_my_ads_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('dashboard_favorite_ads_background')){
            $rules['dashboard_favorite_ads_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('dashboard_messenger_background')){
            $rules['dashboard_messenger_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }

        if($request->hasFile('dashboard_plan_background')){
            $rules['dashboard_plan_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }
        if($request->hasFile('dashboard_account_setting_background')){
            $rules['dashboard_account_setting_background'] =  ['mimes:png,jpg,jpeg','max:1024'];
        }




        if($request->hasFile('dashboard_overview_background')){
            deleteImage($cms->dashboard_overview_background);
            $data['dashboard_overview_background'] =  uploadImage($request->dashboard_overview_background, 'banners');
        }
        if($request->hasFile('dashboard_post_ads_background')){
            deleteImage($cms->dashboard_post_ads_background);
            $data['dashboard_post_ads_background'] =  uploadImage($request->dashboard_post_ads_background, 'banners');
        }

        if($request->hasFile('dashboard_my_ads_background')){
            deleteImage($cms->dashboard_my_ads_background);
            $data['dashboard_my_ads_background'] =  uploadImage($request->dashboard_my_ads_background, 'banners');
        }
        if($request->hasFile('dashboard_favorite_ads_background')){
            deleteImage($cms->dashboard_favorite_ads_background);
            $data['dashboard_favorite_ads_background'] =  uploadImage($request->dashboard_favorite_ads_background, 'banners');
        }
        if($request->hasFile('dashboard_messenger_background')){
            deleteImage($cms->dashboard_messenger_background);
            $data['dashboard_messenger_background'] =  uploadImage($request->dashboard_messenger_background, 'banners');
        }

        if($request->hasFile('dashboard_plan_background')){
            deleteImage($cms->dashboard_plan_background);
            $data['dashboard_plan_background'] =  uploadImage($request->dashboard_plan_background, 'banners');
        }
        if($request->hasFile('dashboard_account_setting_background')){
            deleteImage($cms->dashboard_account_setting_background);
            $data['dashboard_account_setting_background'] =  uploadImage($request->dashboard_account_setting_background, 'banners');
        }

        $request->validate($rules);
        $cms->update($data);

        return redirect()->back()->with('success', 'Dashboard Settings update successfully!');
    }




    /**
     * Update Blog Background Image
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateBlog(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        if($request->hasFile('blog_background')){
            $request->validate([
                'blog_background' =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);

            $cms =  Cms::first();
            deleteImage($cms->blog_background);
            $url =  uploadImage($request->blog_background, 'banners');
            $cms->update(['blog_background'=> $url]);
        }

        return redirect()->back()->with('success', 'Blog Settings update successfully!');
    }



    /**
     * Update Ads Background Image
     *
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateAds(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        if($request->hasFile('ads_background')){
            $request->validate([
                'ads_background' =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);

            $cms =  Cms::first();
            deleteImage($cms->ads_background);
            $url =  uploadImage($request->ads_background, 'banners');
            $cms->update(['ads_background'=> $url]);
        }

        return redirect()->back()->with('success', 'Ads Settings update successfully!');
    }


    /**
     * Update Contact Background Image
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function updateContact(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        if($request->hasFile('contact_background')){
            $request->validate([
                'contact_background' =>  ['mimes:png,jpg,jpeg','max:1024']
            ]);

            $cms =  Cms::first();
            deleteImage($cms->contact_background);
            $url =  uploadImage($request->contact_background, 'banners');
            $cms->update(['contact_background'=> $url]);
        }

        return redirect()->back()->with('success', 'Contact Settings update successfully!');
    }
}
