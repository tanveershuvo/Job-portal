<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobApplication;
use App\Payment;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;


class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        $data = [
            'usersCount' => User::count(),
            'activeJobs' => Job::active()->count(),
            'totalJobs' => Job::count(),
            'employerCount' => User::employer()->count(),
            'agentCount' => User::agent()->count(),
            'totalApplicants' => JobApplication::count(),

        ];
        return view('admin.dashboard', $data);
    }
}
