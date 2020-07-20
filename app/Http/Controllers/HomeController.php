<?php

namespace App\Http\Controllers;

use App\Category;
use App\Job;
use App\Mail\ContactUs;
use App\Mail\ContactUsSendToSender;
use App\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::orderBy('category_name', 'asc')->get();
        $premium_jobs = Job::active()->premium()->orderBy('id', 'desc')->with('employer')->get();
        $regular_jobs = Job::active()->orderBy('id', 'desc')->take(15)->get();
        $packages = Pricing::all();
        $blog_posts = Cache::get('postCache');
        return view('home', compact('categories', 'premium_jobs', 'regular_jobs', 'packages', 'blog_posts'));
    }

    public function newRegister()
    {
        $title = __('app.register');
        return view('new_register', compact('title'));
    }

    public function pricing()
    {
        $title = __('app.pricing');
        $packages = Pricing::all();
        return view('pricing', compact('title', 'packages'));
    }

    public function contactUs()
    {
        $title = trans('app.contact_us');
        return view('contact_us', compact('title'));
    }

    public function contactUsPost(Request $request)
    {
        ini_set('memory_limit', -1);

        $rules = [
            'name' => 'required|max:70',
            'email' => 'required|email',
            'subject' => 'required|max:100',
            'message' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        try {

            Mail::send(new ContactUs($request->all()));
            Mail::send(new ContactUsSendToSender($request->all()));

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', '<h4>' . 'smtp_error_message' . '</h4>' . $exception->getMessage());
        }

        return redirect()->back()->with('success', trans('app.message_has_been_sent'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Clear all cache
     */
    public function langSwitch(Request $request)
    {
        Session::put('locale', $request->locale);
        return redirect()->back();

    }

}
