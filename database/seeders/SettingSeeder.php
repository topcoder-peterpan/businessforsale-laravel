<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\ModuleSetting;
use App\Models\SocialSetting;
use App\Models\PaymentSetting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting
        $setting = new Setting();
        $setting->name = "Site Name";
        $setting->facebook = "https://facebook.com/zakirsoft";
        $setting->twitter = "https://twitter.com/zakirsoft";
        $setting->instagram = "https://instagram.com/zakirsoft";
        $setting->youtube = "https://www.youtube.com/channel/UCMSp_qPtYbaUMjEICDLhDCQ";
        $setting->linkdin = "https://www.linkedin.com/in/zakirsoft";
        $setting->whatsapp = "https://web.whatsapp.com/";
        $setting->phone = '634-564-564';
        $setting->address = 'U.S.A addresses by house number, Florida';
        $setting->email = "example@mail.com";
        $setting->android = "https://play.google.com/store/apps/details?id=com.zakirsoft";
        $setting->ios = "https://play.google.com/store/apps/details?id=com.zakirsoft";
        $setting->map_address = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14607.607282694651!2d90.39911678036226!3d23.75088025342449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b888ad339cb5%3A0x20c70986185ad2ba!2sMogbazar%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1630902791750!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $setting->logo_image = "frontend/images/logo.png";
        $setting->logo_image2 = "frontend/images/logo-white.png";
        $setting->favicon_image = "frontend/images/icon/notepad.png";
        $setting->free_ad_limit = 3;
        $setting->free_featured_ad_limit = 1;
        $setting->save();

        // Module Setting
        ModuleSetting::create([
            'blog' => true,
            'newsletter' => true,
            'language' => true,
            'contact' => true,
            'faq' => true,
            'testimonial' => true,
            'price_plan' => true,
            'appearance' => true,
        ]);

        // Social Setting
        SocialSetting::create([
            'google' => false,
            'facebook' => false,
            'twitter' => false,
            'linkedin' => false,
            'github' => false,
            'gitlab' => false,
            'bitbucket' => false,
        ]);

        // Payment Setting
        PaymentSetting::create([
            'paypal' => false,
            'paypal_live_mode' => false,
            'stripe' => false,
            'razorpay' => false,
            'paystack' => false,
            'ssl_commerz' => false,
        ]);
    }
}
