<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function langSwitch($local)
    {
        Session::put('locale', $local);
        return redirect()->back();

    }
}
