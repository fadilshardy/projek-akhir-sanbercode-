<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Question;
use App\Answer;
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
        $profile = Profile::where('user_id','=',Auth::user()->id)->first();
        //dd($profile);
        $question = Question::where('user_id',Auth::user()->id)->count();
        $answer = Answer::where('user_id',Auth::user()->id)->count();
        //dd($answer);
        return view('profile.index', compact('profile','question','answer'));
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
        $profile = Profile::where('user_id','=',$id)->first();
        //dd($profile);
        $question = Question::where('user_id',$id)->count();
        $answer = Answer::where('user_id',$id)->count();
        $user = User::where('id',$id)->first();
        //dd($answer);
        return view('profile.show', compact('profile','question','answer','user'));
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
}
