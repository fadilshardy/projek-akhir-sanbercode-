<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('\App\User');
    }
    public function tag(){
        return $this->belongsToMany('App\Tag','question_tag','question_id','tag_id');
    }
//     public function comment_question(){
//          return $this->belongsTo('App\Comment_Question','comment_on_question','question_id','user_id');
//  }
}
