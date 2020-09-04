<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\Divison;
use App\Http\Requests\RegisterEmployerRequest;
use App\Http\Requests\registerJobSeekerRequest;
use App\JobApplication;
use App\RecruiterDetails;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{

    public function index()
    {
        $title = trans('app.users');
        $current_user = Auth::user();
        $users = User::where('id', '!=', $current_user->id)->orderBy('name', 'asc')->paginate(20);
        return view('admin.users', compact('title', 'users'));
    }

    public function show($id = 0)
    {
        if ($id) {
            $title = trans('app.profile');
            $user = User::find($id);

            $is_user_id_view = true;
            return view('admin.profile', compact('title', 'user', 'is_user_id_view'));
        }
    }

    /**
     * @param $id
     * @param null $status
     * @return RedirectResponse
     */
    public function statusChange($id, $status = null)
    {

        $user = User::find($id);
        if ($user && $status) {
            if ($status == 'approve') {
                $user->active_status = 1;
                $user->save();

            } elseif ($status == 'block') {
                $user->active_status = 2;
                $user->save();
            }
        }
        return back()->with('success', trans('app.status_updated'));
    }

    public function appliedJobs()
    {
        $title = __('app.applicant');
        $user_id = Auth::user()->id;
        $applications = JobApplication::whereUserId($user_id)->orderBy('id', 'desc')->paginate(20);

        return view('admin.applied_jobs', compact('title', 'applications'));
    }

    public function registerJobSeeker()
    {
        $title = __('app.register_job_seeker');
        return view('register-job-seeker', compact('title'));
    }

    public function registerJobSeekerPost(registerJobSeekerRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'user_type' => 'user',
            'password' => bcrypt($request['password']),
            'active_status' => 1,
        ]);
        Session::flash('message', ['status' => 'success', 'data' => 'Registration Successfull']);
        return Redirect::to('/login');
    }

    public function registerEmployer()
    {
        $title = __('app.employer_register');
        $categories = Category::orderBy('category_name', 'asc')->get();
        $divisions = Divison::orderBy('name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        return view('employer-register', compact('title', 'categories', 'divisions', 'districts'));
    }

    public function registerEmployerPost(RegisterEmployerRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'user_type' => 'employer',
            ]);
            RecruiterDetails::create([
                'user_id' => $user->id,
                'company_name' => $request['company_name'],
                'category_id' => $request['category'],
                'division_id' => $request['division'],
                'district_id' => $request['district'],
                'address' => $request['address'],
                'trade_licence_no' => $request['trade_license'],
                'rl_no' => $request['rl_no'],
                'company_description' => $request['description'],
                'website_url' => $request['website_url'],
                'contact_name' => $request['contact_name'],
                'contact_phone' => $request['contact_phone'],
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            flashMessage('danger', $e->getMessage());
            return Redirect::back();
        }
        flashMessage('success', 'Registration Completed!');
        return Redirect::to('/login');
    }

    public function employerProfile()
    {
        $title = __('app.employer_profile');
        $user = Auth::user();

        return view('admin.employer-profile', compact('title', 'user'));
    }

    public function employerProfilePost(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'company_size' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
        ];

        $this->validate($request, $rules);

        $logo = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');

            $valid_extensions = ['jpg', 'jpeg', 'png'];
            if (!in_array(strtolower($image->getClientOriginalExtension()), $valid_extensions)) {
                return redirect()->back()->withInput($request->input())->with('error', 'Only .jpg, .jpeg and .png is allowed extension');
            }
            $file_base_name = str_replace('.' . $image->getClientOriginalExtension(), '', $image->getClientOriginalName());
            $resized_thumb = Image::make($image)->resize(256, 256)->stream();

            $logo = strtolower(time() . str_random(5) . '-' . str_slug($file_base_name)) . '.' . $image->getClientOriginalExtension();

            $logoPath = 'uploads/images/logos/' . $logo;

            try {
                Storage::disk('public')->put($logoPath, $resized_thumb->__toString());
            } catch (\Exception $e) {
                return redirect()->back()->withInput($request->input())->with('error', $e->getMessage());
            }
        }

        $data = [
            'company_size' => $request->company_size,
            'phone' => $request->phone,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'country_id' => $request->country,
            'country_name' => $country->country_name,
            'about_company' => $request->about_company,
            'website' => $request->website,
        ];

        if ($logo) {
            $data['logo'] = $logo;
        }

        $user->update($data);

        return back()->with('success', __('app.updated'));
    }

    public function employerApplicant()
    {
        $title = __('app.applicant');
        $employer_id = Auth::user()->id;
        $applications = JobApplication::whereEmployerId($employer_id)->orderBy('id', 'desc')->paginate(20);

        return view('admin.applicants', compact('title', 'applications'));
    }

    public function makeShortList($application_id)
    {
        $applicant = JobApplication::find($application_id);
        $applicant->is_shortlisted = 1;
        $applicant->save();
        return back()->with('success', __('app.success'));
    }

    public function shortlistedApplicant()
    {
        $title = __('app.shortlisted');
        $employer_id = Auth::user()->id;
        $applications = JobApplication::whereEmployerId($employer_id)->whereIsShortlisted(1)->orderBy('id', 'desc')->paginate(20);

        return view('admin.applicants', compact('title', 'applications'));
    }

    public function profile()
    {
        $title = trans('app.profile');
        $user = Auth::user();
        return view('admin.profile', compact('title', 'user'));
    }

    public function profileEdit($id = null)
    {
        $title = trans('app.profile_edit');
        $user = Auth::user();

        if ($id) {
            $user = User::find($id);
        }

        return view('admin.profile_edit', compact('title', 'user'));
    }

    public function profileEditPost($id = null, Request $request)
    {
        if (config('app.is_demo')) {
            return redirect()->back()->with('error', 'This feature has been disable for demo');
        }

        $user = Auth::user();
        if ($id) {
            $user = User::find($id);
        }
        //Validating
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];
        $this->validate($request, $rules);

        $inputs = array_except($request->input(), ['_token', 'photo']);
        $user->update($inputs);

        return back()->with('success', trans('app.profile_edit_success_msg'));
    }

    public function changePassword()
    {
        $title = trans('app.change_password');
        return view('admin.change_password', compact('title'));
    }

    public function changePasswordPost(Request $request)
    {

        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ];
        $this->validate($request, $rules);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        //$new_password_confirmation = $request->new_password_confirmation;

        if (Auth::check()) {
            $logged_user = Auth::user();

            if (Hash::check($old_password, $logged_user->password)) {
                $logged_user->password = Hash::make($new_password);
                $logged_user->save();
                return redirect()->back()->with('success', trans('app.password_changed_msg'));
            }
            return redirect()->back()->with('error', trans('app.wrong_old_password'));
        }
    }

}
