<?php

namespace App\Http\Controllers\Traits;

use App\Flyer;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;


trait AuthorizesUser
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function unauthorized(Request $request)
    {
        if ($request->ajax()) {
            return response(['message' => 'No Way'], 403);
        }

        flash('No Way');

        return redirect('/');
    }


    public function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip'     => $request->zip,
            'street'  => $request->street,
            'user_id' => Auth::id(),
        ])->exists();
    }
}