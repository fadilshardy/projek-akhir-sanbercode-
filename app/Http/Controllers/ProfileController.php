<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $detail = Profile::get_profile(Auth::user()->id);
        //dd($detail);
        return view('profile.index', $detail);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $profile = Profile::create([
            'full_name' =>$request['full_name'],
            'address' =>$request['address'],
            'user_id' =>Auth::user()->id,
            'photo' =>'avatar.jpg',
        ]);
        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $detail = Profile::get_profile($id);
        //dd($detail);
        return view('profile.show', $detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $profile=Profile::where('user_id','=',Auth::user()->id)->first();
        return view('profile.edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $profile=Profile::where('user_id','=',Auth::user()->id)->update([
            'full_name' =>$request['full_name'],
            'address' =>$request['address'],
        ]);    
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function rank(){
        $user = User::orderBy('point', 'desc')->get();
        //dd($user);
        return view('profile.rank', compact('user'));
    }
}
