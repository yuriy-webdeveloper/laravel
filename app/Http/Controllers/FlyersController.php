<?php

namespace App\Http\Controllers;

use App;
use App\Flyer;
use App\Http\Requests\ChangeFlyerRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Traits\AuthorizesUser;
use Illuminate\Support\Facades\Auth;

class FlyersController extends Controller
{

    //use AuthorizesUser;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        $flyer = $this->user->publish(
            new Flyer($request->all())
        );

        flash('Created')->important();

        return redirect($flyer->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Add photos to a flyer
     *
     * @param $zip
     * @param $street
     * @param ChangeFlyerRequest|Request $request
     * @return string
     */
    public function addPhoto($zip, $street, ChangeFlyerRequest $request)
    {
//        $this->validate($request, [
//            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
//        ]);
//
//        if (!$this->userCreatedFlyer($request)) {
//            return $this->unauthorized($request);
//        }

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Ok';
    }


    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }


    /**
     * Delete a photo by id
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePhoto($id)
    {
        Photo::findOrFail($id)->delete();

        return back();
    }


}


