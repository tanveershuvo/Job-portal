<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialiteController extends Controller
{
    /**
     * Handle Social login request
     *
     * @param $social
     * @return RedirectResponse
     */
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Application|Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function handleProviderCallback($social)
    {
        try {
            $userSocial = Socialite::driver($social)->stateless()->user();
            $arr = ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()];
            return Redirect::to('/job-seeker-register')->with('arr', $arr);
        } catch (RequestException $e) {
            $response = array([
                'reason' => $e->getResponse()->getReasonPhrase(),
                'code' => $e->getResponse()->getStatusCode(),
            ]);
            Session::flash('message', $response);
            return view('register-job-seeker');
        }
    }
}
