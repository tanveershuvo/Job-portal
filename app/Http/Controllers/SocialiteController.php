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
        try {
            $userSocial = Socialite::driver($social)->stateless()->user();
            $arr = ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()];
            return redirect('/job-seeker-register')->with('arr', $arr);

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
