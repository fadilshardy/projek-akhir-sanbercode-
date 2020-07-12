<?php

namespace App;

use App\Helpers\CollectionHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{

    public function answers()
    {
        return $this->hasMany('\App\Answer');
    }
    protected $guarded = [];

    public static function get_data()
    {
        $question = Question::withCount('answers')->get();
        $question = $question->sortByDesc(function ($question) {
            $downvote = 0;
            $upvote = 0;
            foreach ($question->votes as $vote) {
                if ($vote->voted == 0) {
                    $downvote += 1;

                } else {
                    $upvote += 1;
                }
            }
            //dd($upvote-$downvote);
            return $upvote - $downvote;
        });
        $question = CollectionHelper::paginate($question, 10);
        return $question;
    }
    public static function search_data($param, $selector, $value)
    {
        if ($selector == "in") {
            $question = Question::whereIn($param, $value)->withCount('answers')->get();
        } else {
            $question = Question::where($param, $selector, $value)->withCount('answers')->get();
        }
        $question = $question->sortByDesc(function ($question) {
            $downvote = 0;
            $upvote = 0;
            foreach ($question->votes as $vote) {
                if ($vote->voted == 0) {
                    $downvote += 1;

                } else {
                    $upvote += 1;
                }
            }
            //dd($upvote-$downvote);
            return $upvote - $downvote;
        });
        $question = CollectionHelper::paginate($question, 10);

        return $question;
    }
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
        $user = User::find(auth()->id());

        $question = $this->votes()->where('user_id', auth()->id())
            ->where('question_id', $this->id);

        if ($question->exists()) {
            $this->unvote('upvote');
        } else if ($user->point <= 15) {
            return "anda tidak memiliki point yang cukup untuk melakukan downvote";
        } else {
            $this->votes()->updateOrCreate([
                'user_id' => auth()->id(),
            ], [
                'voted' => false,
            ]);
            $this->point('downvote');
        }

    }

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

        if ($status === 0) {
            return 'downvote';
        } else if ($status === 1) {
            return 'upvote';
        }
    }

}
