<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;

    protected $table ='cms';



    protected $fillable = [
        'index1_main_banner', 'index1_counter_background', 'index1_mobile_app_banner', 'index2_search_filter_background', 'index2_get_membership_background', 'index3_search_filter_background', 'terms_background', 'terms_body', 'about_video_thumb', 'about_body', 'privacy_background', 'privacy_body', 'contact_background', 'get_membership_background', 'get_membership_image', 'pricing_plan_background', 'faq_background', 'dashboard_overview_background', 'dashboard_post_ads_background', 'dashboard_my_ads_background', 'dashboard_plan_background', 'dashboard_account_setting_background', 'posting_rules_background', 'posting_rules_body', 'about_background', 'dashboard_favorite_ads_background', 'dashboard_messenger_background', 'blog_background', 'ads_background',
    ];





    public function getIndex1MainBannerPathAttribute()
    {
       return file_exists($this->index1_main_banner) ? asset($this->index1_main_banner) : asset('frontend/default_images/index1_main_banner.png');
    }


    public function getIndex1CounterBackgroundPathAttribute()
    {
       return file_exists($this->index1_counter_background) ? asset($this->index1_counter_background) : asset('frontend/default_images/index1_counter_background.png');
    }


    public function getIndex1MobileAppBannerPathAttribute()
    {
       return file_exists($this->index1_mobile_app_banner) ? asset($this->index1_mobile_app_banner) : asset('frontend/default_images/index1_mobile_app_banner.png');
    }


    public function getIndex2SearchFilterBackgroundPathAttribute()
    {
       return file_exists($this->index2_search_filter_background) ? asset($this->index2_search_filter_background) : asset('frontend/default_images/index2_search_filter_background.png');
    }


    public function getIndex2GetMembershipBackgroundPathAttribute()
    {
       return file_exists($this->index2_get_membership_background) ? asset($this->index2_get_membership_background) : asset('frontend/default_images/index2_get_membership_background.png');
    }


    public function getIndex3SearchFilterBackgroundPathAttribute()
    {
       return file_exists($this->index3_search_filter_background) ? asset($this->index3_search_filter_background) : asset('frontend/default_images/index3_search_filter_background.png');
    }


    public function getTermsBackgroundPathAttribute()
    {
       return file_exists($this->terms_background) ? asset($this->terms_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getPrivacyBackgroundPathAttribute()
    {
       return file_exists($this->privacy_background) ? asset($this->privacy_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getAboutVideoThumbPathAttribute()
    {
       return file_exists($this->about_video_thumb) ? asset($this->about_video_thumb) : asset('frontend/default_images/about_video_thumb.png');
    }


    public function getAboutBackgroundPathAttribute()
    {
        return file_exists($this->about_background) ? asset($this->about_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getPricingPlanBackgroundPathAttribute()
    {
       return file_exists($this->pricing_plan_background) ? asset($this->pricing_plan_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getFaqBackgroundPathAttribute()
    {
       return file_exists($this->faq_background) ? asset($this->faq_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardOverviewBackgroundPathAttribute()
    {
       return file_exists($this->dashboard_overview_background) ? asset($this->dashboard_overview_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardPostAdsBackgroundPathAttribute()
    {
       return file_exists($this->dashboard_post_ads_background) ? asset($this->dashboard_post_ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardMyAdsBackgroundPathAttribute()
    {
       return file_exists($this->dashboard_my_ads_background) ? asset($this->dashboard_my_ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardPlanBackgroundPathAttribute()
    {
       return file_exists($this->dashboard_plan_background) ? asset($this->dashboard_plan_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardAccountSettingBackgroundPathAttribute()
    {
       return file_exists($this->dashboard_account_setting_background) ? asset($this->dashboard_account_setting_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getPostingRulesBackgroundPathAttribute()
    {
       return file_exists($this->posting_rules_background) ? asset($this->posting_rules_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getGetMembershipBackgroundPathAttribute()
    {
       return file_exists($this->posting_rules_background) ? asset($this->posting_rules_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getDashboardFavoriteAdsBackgroundPathAttribute()
    {
        return file_exists($this->dashboard_favorite_ads_background) ? asset($this->dashboard_favorite_ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getDashboardMessengerBackgroundPathAttribute()
    {
        return file_exists($this->dashboard_messenger_background) ? asset($this->dashboard_messenger_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getBlogBackgroundPathAttribute()
    {
       return file_exists($this->blog_background) ? asset($this->blog_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getAdsBackgroundPathAttribute()
    {
       return file_exists($this->ads_background) ? asset($this->ads_background) : asset('frontend/default_images/default_background.jpg');
    }


    public function getContactBackgroundPathAttribute()
    {
       return file_exists($this->contact_background) ? asset($this->contact_background) : asset('frontend/default_images/default_background.jpg');
    }

    public function getDefaultBackgroundPathAttribute()
    {
       return asset('frontend/default_images/default_background.jpg');
    }

}
