<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SocialSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('customer.login');
        }

        $socialiteUserId = $socialiteUser->getId();
        $socialiteUserName = $socialiteUser->getName();
        $socialiteUseremail = $socialiteUser->getEmail();

        $user = Customer::where([
            'provider' => $provider,
            'provider_id' =>  $socialiteUserId,
        ])->first();

        if (!$user) {

            $validator = Validator::make(
                ['email' => $socialiteUseremail],
                ['email' => ['unique:customers,email']],
                ['email.unique' => 'Couldn\'t login. Maybe you used a different login method?'],
            );

            if ($validator->fails()) {
                return redirect()->route('customer.login')->withErrors($validator);
            }

            $usernameExists = Customer::where('username', Str::slug($socialiteUserName))->count();

            if ($usernameExists) {
                $username = Str::slug($socialiteUserName) . '_' . Str::random(5);
            } else {
                $username = Str::slug($socialiteUserName);
            }

            $user = Customer::create([
                'name' => $socialiteUserName,
                'email' => $socialiteUseremail,
                'username' => $username,
                'provider' => $provider,
                'provider_id' =>  $socialiteUserId,
            ]);
        }

        Auth::guard('customer')->login($user);
        storePlanInformation();
        loggedinNotification();
        resetSessionWishlist();

        return redirect()->route('frontend.dashboard');
    }

    public function dataUpdate(Request $request, $provider)
    {
        $socialSetting = SocialSetting::first();

        switch ($provider) {
            case 'google':
                if ($request->google) {
                    $request->validate([
                        'google_id' => 'required|string',
                        'google_secret' => 'required|string',
                    ]);
                }
                $this->googleSettings($request, $socialSetting);
                break;
            case 'facebook':
                if ($request->facebook) {
                    $request->validate([
                        'facebook_id' => 'required|string',
                        'facebook_secret' => 'required|string',
                    ]);
                }
                $this->facebookSettings($request, $socialSetting);
                break;
            case 'twitter':
                if ($request->twitter) {
                    $request->validate([
                        'twitter_id' => 'required|string',
                        'twitter_secret' => 'required|string',
                    ]);
                }
                $this->twitterSettings($request, $socialSetting);
                break;
            case 'linkedin':
                if ($request->linkedin) {
                    $request->validate([
                        'linkedin_id' => 'required|string',
                        'linkedin_secret' => 'required|string',
                    ]);
                }
                $this->linkedinSettings($request, $socialSetting);
                break;
            case 'github':
                if ($request->github) {
                    $request->validate([
                        'github_id' => 'required|string',
                        'github_secret' => 'required|string',
                    ]);
                }
                $this->githubSettings($request, $socialSetting);
                break;
            case 'gitlab':
                if ($request->gitlab) {
                    $request->validate([
                        'gitlab_id' => 'required|string',
                        'gitlab_secret' => 'required|string',
                    ]);
                }
                $this->gitlabSettings($request, $socialSetting);
                break;
            case 'bitbucket':
                if ($request->bitbucket) {
                    $request->validate([
                        'bitbucket_id' => 'required|string',
                        'bitbucket_secret' => 'required|string',
                    ]);
                }
                $this->bitbucketSettings($request, $socialSetting);
                break;
        }


        flashSuccess('Social Setting Updated Successfully');
        return back();

        return $request->all();
    }

    public function googleSettings($request, $socialSetting)
    {
        envReplace('GOOGLE_CLIENT_ID', $request->google_id);
        envReplace('GOOGLE_CLIENT_SECRET', $request->google_secret);

        return $socialSetting->update(['google' => $request->google ?? false]);
    }

    public function facebookSettings($request, $socialSetting)
    {
        envReplace('FACEBOOK_CLIENT_ID', $request->facebook_id);
        envReplace('FACEBOOK_CLIENT_SECRET', $request->facebook_secret);
        return $socialSetting->update(['facebook' => $request->facebook ?? false]);
    }

    public function twitterSettings($request, $socialSetting)
    {
        envReplace('TWITTER_CLIENT_ID', $request->twitter_id);
        envReplace('TWITTER_CLIENT_SECRET', $request->twitter_secret);
        return $socialSetting->update(['twitter' => $request->twitter ?? false]);
    }

    public function linkedinSettings($request, $socialSetting)
    {
        envReplace('LINKEDIN_CLIENT_ID', $request->linkedin_id);
        envReplace('LINKEDIN_CLIENT_SECRET', $request->linkedin_secret);
        return $socialSetting->update(['linkedin' => $request->linkedin ?? false]);
    }

    public function githubSettings($request, $socialSetting)
    {
        envReplace('GITHUB_CLIENT_ID', $request->github_id);
        envReplace('GITHUB_CLIENT_SECRET', $request->github_secret);
        return $socialSetting->update(['github' => $request->github ?? false]);
    }

    public function gitlabSettings($request, $socialSetting)
    {
        envReplace('GITLAB_CLIENT_ID', $request->gitlab_id);
        envReplace('GITLAB_CLIENT_SECRET', $request->gitlab_secret);
        return $socialSetting->update(['gitlab' => $request->gitlab ?? false]);
    }

    public function bitbucketSettings($request, $socialSetting)
    {
        envReplace('BITBUCKET_CLIENT_ID', $request->bitbucket_id);
        envReplace('BITBUCKET_CLIENT_SECRET', $request->bitbucket_secret);
        return $socialSetting->update(['bitbucket' => $request->bitbucket ?? false]);
    }
}
