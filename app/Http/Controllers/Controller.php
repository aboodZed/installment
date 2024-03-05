<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function lang($lang)
    {
        Cookie::queue(Cookie::make('lang', $lang, 60));
        return redirect()->back();
    }
}
