<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;


    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->user = request()->user();
            view()->share('user', request()->user());
            view()->share('signedIn', Auth::check());
            return $next($request);
        });


    }

}

