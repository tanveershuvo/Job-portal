<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
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
            dd($userSocial);
            return view('register-job-seeker')->with('arr', $arr);

        } catch (RequestException $e) {
            // $response = 0;
            $response = array([
                'reason' => $e->getResponse()->getReasonPhrase(),
                'code' => $e->getResponse()->getStatusCode(),
            ]);
            // dd($response);
            Session::flash('message', $response);
            return Redirect::to('/job-seeker-register');

        }
    }

}
