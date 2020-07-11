<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    //
    protected $table = "answers";
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo('\App\Question');
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function comment_on_answer()
    {
        return $this->hasMany('App\Comment_Answer');
    }

    public function is_author()
    {
        return $this->user->id == auth()->id();
    }

    public function upvote_count()
    {
        $count = DB::table('vote_answers')
            ->where('answer_id', $this->id)
            ->where('voted', '=', true)
            ->count();
        return $count;
    }

    public function downvote_count()
    {
        $count = DB::table('vote_answers')
            ->where('answer_id', $this->id)
            ->where('voted', '=', false)
            ->count();
        return $count;
    }

    public function point($vote)
    {
        if ($vote == 'upvote') {
            $user = $this->user;
            $user->point += 10;
            $user->save();
        } else if ($vote == 'downvote') {
            $user = $this->user;
            $user->point -= 1;
            $user->save();
        }
    }

    public function upvote()
    {
        $question = $this->votes()->where('user_id', auth()->id())
            ->where('answer_id', $this->id);

        if ($question->exists()) {
            return $this->unvote('downvote');
        } else {
            $this->votes()->updateOrCreate([
                'user_id' => auth()->id(),
            ], [
                'voted' => true,
            ]);
            $this->point('upvote');
        }

    }

    public function downvote()
    {
        $question = $this->votes()->where('user_id', auth()->id())
            ->where('answer_id', $this->id);

        $user = User::find(auth()->id());

        if ($question->exists()) {
            return $this->unvote('upvote');
        } else if ($user->point <= 15) {
            return "anda tidak memiliki point yang cukup untuk melakukan downvote";
        } else {
            $this->votes()->updateOrCreate([
                'user_id' => auth()->id(),
            ], [
                'voted' => false,
            ]);
            $this->point('downvote');
        }}

    public function unvote($vote)
    {
        if ($vote == 'upvote') {
            $user = $this->user;
            $user->point -= 10;
            $user->save();
        } else {
            $user = $this->user;
            $user->point += 1;
            $user->save();
        }

        $this->votes()->where('user_id', auth()->id())->first()->delete();
    }

    public function votes()
    {
        return $this->hasMany(VoteAnswer::class);
    }

    public function vote_status()
    {
        $status = DB::table('vote_answers')
            ->where('answer_id', $this->id)
            ->where('user_id', auth()->id())
            ->value('voted');

        return $status;
    }

}
