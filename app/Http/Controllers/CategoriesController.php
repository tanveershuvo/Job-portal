<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $title = trans('app.categories');
        $categories = Category::orderBy('id', 'desc')->get();

        return view('admin.categories', compact('title', 'categories'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required',
        ];
        $this->validate($request, $rules);

        $slug = Str::slug($request->category_name);
        $duplicate = Category::where('category_slug', $slug)->count();
        if ($duplicate > 0) {
            return back()->with('error', trans('app.category_exists_in_db'));
        }

        $data = [
            'category_name' => $request->category_name,
            'category_slug' => $slug,
        ];

        Category::create($data);
        return back()->with('success', trans('app.category_created'));
    }

    /**
     * @param $id
     * @return View
     */
    public
    function edit($id)
    {
        $title = trans('app.edit_category');
        $category = Category::find($id);
        return view('admin.edit_category', compact('title', 'category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        if (env('IS_DEMO')) {
            return back()->with('error', __('app.disable_for_demo'));
        }

        $rules = [
            'category_name' => 'required',
        ];
        $this->validate($request, $rules);
        $slug = Str::slug($request->category_name);
        $duplicate = Category::where('category_slug', $slug)->where('id', '!=', $id)->count();
        if ($duplicate > 0) {
            return back()->with('error', trans('app.category_exists_in_db'));
        }

        $data = [
            'category_name' => $request->category_name,
            'category_slug' => $slug,
        ];
        Category::where('id', $id)->update($data);
        return back()->with('success', trans('app.category_updated'));
    }

    /**
     * @param Request $request
     * @return array|RedirectResponse
     * @throws Exception
     */
    public
    function destroy(Request $request)
    {
        if (env('IS_DEMO')) {
            return back()->with('error', __('app.disable_for_demo'));
        }
        $id = $request->data_id;
        $delete = Category::where('id', $id)->delete();
        if ($delete) {
            return ['success' => 1, 'msg' => trans('app.category_deleted_success')];
        }
        return ['success' => 0, 'msg' => trans('app.error_msg')];
    }

}
