<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = [];
    public function question()
    {
        return $this->belongsToMany('App\Question', 'question_tag', 'tag_id','question_id');
    }
}
