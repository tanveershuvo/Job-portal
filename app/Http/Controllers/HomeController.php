<?php

namespace App\Http\Controllers;

use App\Job;
use App\Jobs\SendContactUsMailJob;
use App\Jobs\SendContactUsSendToSenderMailJob;
use App\Mail\ContactUs;
use App\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

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

        $categories = cache()->get('categoryCache');
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
        ];

        $this->validate($request, $rules);

        try {

            SendContactUsMailJob::withChain([
                new SendContactUsSendToSenderMailJob($request->all()),
            ])->dispatch($request->all())
                ->delay(Carbon::now()->addSeconds(10));

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
    public function clearCache()
    {
        Artisan::call('debugbar:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        if (function_exists('exec')) {
            exec('rm ' . storage_path('logs/*'));
        }
        return redirect(route('home'));
    }

}
