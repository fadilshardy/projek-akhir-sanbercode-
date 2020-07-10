<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    protected $guarded = [];

    public function is_author()
    {
        return $this->user->id == auth()->id();
    }

    public function upvote_count()
    {
        $count = DB::table('vote_questions')
            ->where('question_id', $this->id)
            ->where('voted', '=', true)
            ->count();
        return $count;
    }

    public function downvote_count()
    {
        $count = DB::table('vote_questions')
            ->where('question_id', $this->id)
            ->where('voted', '=', false)
            ->count();
        return $count;
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function tag()
    {
        return $this->belongsToMany('App\Tag', 'question_tag', 'question_id', 'tag_id');
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
            ->where('question_id', $this->id);

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
            ->where('question_id', $this->id);

        if ($question->exists()) {
            return $this->unvote('upvote');
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
        return $this->hasMany(VoteQuestion::class);
    }

    public function vote_status()
    {
        $status = DB::table('vote_questions')
            ->where('question_id', $this->id)
            ->where('user_id', auth()->id())
            ->value('voted');

        return $status;
    }

}
