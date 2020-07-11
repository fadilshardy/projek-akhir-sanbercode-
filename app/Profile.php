<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Answer;
use App\User;
class Profile extends Model
{
    //
    protected $table = "profiles";
    protected $guarded = [];

    public static function get_profile($id){
        $user = User::where('id','=',$id)->first();
        //dd($user->profile);
        //$user = User::where('id',$id)->withCount('question')->withCount('answer')->first();
        //dd($profile->user->question);
        return compact('user');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
