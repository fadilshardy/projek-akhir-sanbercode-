<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Question extends Model
{
    //
    protected $table = "comment_on_question";
    protected $guarded = [];
    public function question(){
        return $this->belongsTo('\App\Question');
    }
    public function user(){
        return $this->belongsTo('\App\User');
    }
}
