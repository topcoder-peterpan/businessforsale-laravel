<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Setting;
use App\Mail\SendTestMail;
use Illuminate\Http\Request;
use App\Models\ModuleSetting;
use App\Models\SocialSetting;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    /**
     * Website setting page.
     *
     * @param  string $page
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        if (!userCan('setting.view')) {
            return abort(403);
        }

        $setting = Setting::first();
        $modulesetting = ModuleSetting::first();
        $socialsetting = SocialSetting::first();
        $paymentsetting = PaymentSetting::first();

        switch ($page) {
            case 'website':
                if (!session('website_setting_section')) {
                    session(['website_setting_section' => 'basic']);
                }

                return view('backend.settings.pages.website', compact('setting'));
                break;
            case 'layout':
                return view('backend.settings.pages.layout');
                break;
            case 'color':
                return view('backend.settings.pages.color-picker');
                break;
            case 'custom':
                return view('backend.settings.pages.custom', compact('setting'));
                break;
            case 'mail':
                return view('backend.settings.pages.mail');
                break;
            case 'payment':
                return view('backend.settings.pages.payment', compact('paymentsetting'));
                break;
            case 'module':
                return view('backend.settings.pages.module', compact('modulesetting'));
                break;
            case 'seo':
                return view('backend.settings.pages.seo', compact('setting'));
                break;
            case 'cms':
                $cms = Cms::first();
                return view('backend.settings.pages.cms', compact('cms'));
                break;
            case 'social_login':
                return view('backend.settings.pages.social_login', compact('socialsetting'));
                break;
            default:
                abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        switch ($page) {
            case 'website':
                $this->validate($request, [
                    'name' => "sometimes|required",
                    'email' => "sometimes|required",
                    'phone' => "sometimes|required",
                    'address' => "sometimes|required",
                    'map_address' => "sometimes|required",
                ]);

                $this->websiteUpdate($request);
                $message = 'Site Settings Content';
                break;
            case 'color':
                if (setting()->dark_mode) {
                    flashWarning("You can't cahnge color.Beacause you're in dark mode.");
                    return back();
                } else {
                    $this->colorUpdate($request);
                    $message = 'Color Setting';
                }
                break;
            case 'custom':
                $this->custumCSSJSUpdate($request);
                $message = 'Custom Setting';
                break;
            case 'mail':
                $this->validate($request, [
                    'host' => "required",
                    'port' => "required|min:2|max:20",
                    'username' => "required|string|min:4|max:30",
                    'password' => "required|min:4|max:30",
                    'encryption' => "required|string",
                    'from_address' => "required|email",
                    'from_name' => "required|string",
                ]);
                $this->mailSUpdate($request);
                $message = 'Mail Setting';
                break;
            case 'dark_mode':
                $this->modeUpdate($request);
                $message = 'Mode';

                break;
            case 'layout':
                $this->layoutUpdate($request);
                $message = 'Layout Setting';
                break;
            case 'module':
                $this->moduleUpdate($request);
                $message = 'Module Setting';
                break;
            default:
                abort(404);
        }

        flashSuccess($message . ' Updated Successfully');
        return back();
    }

    /**
     * Layout Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function layoutUpdate($request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        $layout = $request->only(['default_layout']);
        return Setting::first()->update($layout);
    }

    /**
     * Module Setting Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function moduleUpdate($request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $blog = $request->blog ?? false;
        $newsletter = $request->newsletter ?? false;
        $language = $request->language ?? false;
        $price_plan = $request->price_plan ?? false;
        $testimonial = $request->testimonial ?? false;
        $faq = $request->faq ?? false;
        $contact = $request->contact ?? false;
        $appearance = $request->appearance ?? false;

        return ModuleSetting::first()->update([
            'blog' => $blog,
            'newsletter' => $newsletter,
            'language' => $language,
            'price_plan' => $price_plan,
            'testimonial' => $testimonial,
            'faq' => $faq,
            'contact' => $contact,
            'appearance' => $appearance,
        ]);
    }

    /**
     * Website Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function websiteUpdate($request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        $setting = Setting::first();

        switch ($request->section) {
            case 'basic':
                $data = $request->only(['name', 'email', 'support_email', 'phone', 'address', 'map_address', 'free_ad_limit', 'free_featured_ad_limit']);
                session(['website_setting_section' => 'basic']);
                return $setting->update($data);
                break;
            case 'social_links':
                session(['website_setting_section' => 'social_links']);
                return $setting->update($request->only(['facebook', 'twitter', 'instagram', 'youtube', 'linkdin', 'whatsapp']));
                break;
            case 'logo':
                session(['website_setting_section' => 'logo']);
                if ($logo_image = $request->logo_image) {
                    $url = uploadImage($logo_image, 'website');
                    $setting->update(['logo_image' => $url]);
                }

                if ($logo_image2 = $request->logo_image2) {
                    $url = uploadImage($logo_image2, 'website');
                    $setting->update(['logo_image2' => $url]);
                }

                if ($fav_icon = $request->favicon_image) {
                    $url = uploadImage($fav_icon, 'website');
                    $setting->update(['favicon_image' => $url]);
                }
                return true;
                break;
        }
    }

    /**
     * color Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function colorUpdate($request)
    {
        $color = $request->only(['sidebar_color', 'nav_color']);
        return Setting::first()->update($color);
    }

    /**
     * custom js and css Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function custumCSSJSUpdate($request)
    {
        $custom_css_js = $request->only(['header_css', 'header_script', 'body_script']);
        return Setting::first()->update($custom_css_js);
    }

    /**
     * Mode Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function modeUpdate($request)
    {
        $dark_mode = $request->only(['dark_mode']);
        return Setting::first()->update($dark_mode);
    }

    /**
     * Mode Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function mailSUpdate($request)
    {
        envReplace('MAIL_MAILER', 'smtp');
        envReplace('MAIL_HOST', $request->host);
        envReplace('MAIL_PORT', $request->port);
        envReplace('MAIL_USERNAME', $request->username);
        envReplace('MAIL_PASSWORD', $request->password);
        envReplace('MAIL_ENCRYPTION', $request->encryption);
        envReplace('MAIL_FROM_ADDRESS', $request->from_address);
        envReplace('MAIL_FROM_NAME', $request->from_name);

        return back();
    }

    /**
     * Send test mail.
     *
     * @return \Illuminate\Http\Response
     */
    public function testMailSend(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $subject = 'Test Subject';
        $body = 'Test Body ad asd as das dasdasdas dasd a sdas asd asdsa as asd asd sad asdas ad a';

        Mail::to($request->email)->send(new SendTestMail());

        flashSuccess('Test mail sent Successfully');
        return back();
    }

    /**
     * Update SEO Settings
     *
     * @author Mithun Halder
     * @return void
     */
    public function updateSeo(Request $request)
    {
        Setting::first()->update($request->only(['seo_meta_title', 'seo_meta_description', 'seo_meta_keywords']));

        return redirect()->back()->with('success', 'SEO Settings update successfully!');
    }
}
