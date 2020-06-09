<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialiteController extends Controller
{
    /**
     * Handle Social login request
     *
     * @return response
     */
    public function socialLogin($social)
    {
        //dd($social);
        return Socialite::driver($social)->redirect();
    }
    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        //$userSocial = Socialite::driver($social)->stateless()->user();
        try {
            $userSocial = Socialite::driver($social)->stateless()->user();
            $arr = ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()];
            return view('register-job-seeker')->with('arr', $arr);

        } catch (Exception $e) {
            return Redirect::to('/job-seeker-register');
        }

        //dd($userSocial->getEmail());

        //dd($arr);

    }

}
