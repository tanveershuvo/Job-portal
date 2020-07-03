<?php

namespace App\Repository;

use App\Category;

class CategoryRepository
{

    public function createCategory($request)
    {
        $slug = str_slug($request['category_name']);
        $duplicate = Category::where('category_slug', $slug)->count();
        if ($duplicate > 0) {
            return back()->with('error', trans('app.category_exists_in_db'));
        }

        $data = [
            'category_name' => $request['category_name'],
            'category_slug' => $slug,
        ];

        return Category::create($data);

    }
}
