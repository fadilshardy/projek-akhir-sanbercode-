<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Answer extends Model
{
    //
    protected $table="comment_on_answer";
    protected $guarded = [];
    public function answer(){
        return $this->belongsTo('\App\Answer');
    }
    public function user(){
        return $this->belongsTo('\App\User');
    }
}
