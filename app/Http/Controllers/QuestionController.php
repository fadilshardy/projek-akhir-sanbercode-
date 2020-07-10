<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment_Answer;
use App\Comment_Question;
use App\Question;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
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
        $user = User::orderBy('point', 'desc')->take(5)->get();
        $tag = Tag::all();
        return view('questions.index', [
            'questions' => $question,
            'tag' => $tag,
            'user' => $user,
            // 'questions' => Question::withCount('likes')->orderBy('likes_count')->get(),
        ]);
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $question = Question::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],

        ]);
        //create tag Baru
        $tags = explode(',', strtolower($request->tags));
        $tag_multi = [];
        foreach ($tags as $tag) {
            $tagAss['tag_name'] = $tag;
            $tag_multi[] = $tagAss;
        }
        //dd($tag_multi);
        foreach ($tag_multi as $tag_single) {
            $tag_save = Tag::firstOrCreate($tag_single);
            $question->tag()->attach($tag_save->id);
        }
        //dd($tag_save);
        return redirect('/pertanyaan');
    }

    public function show($id)
    {
        $count = Question::withCount('answers')->where('id', $id)->value('answers_count');
        $question = Question::find($id);
        $question->answers_count = $count;
        $answer = Answer::where('question_id', '=', $id)->get();
        $answer = $answer->sortByDesc(function ($answer) {
            $downvote = 0;
            $upvote = 0;
            foreach ($answer->votes as $vote) {
                if ($vote->voted == 0) {
                    $downvote += 1;

                } else {
                    $upvote += 1;
                }
            }
            //dd($upvote-$downvote);
            return $upvote - $downvote;

        })->sortBy('Case when voted is null then 1 else 0 end')->sortByDesc('is_right_answer');
        $commentq = Comment_Question::where('question_id', '=', $id)->get();
        $commenta = [];
        //dd($answer[0]->comment);
        foreach ($answer as $key => $jawaban) {
            $answer[$key]->comment = Comment_Answer::where('answer_id', '=', $jawaban->id)->get();
        }
        //dd($jawaban->id);
        return view('questions.show', compact('question', 'answer', 'commentq'));
    }

    public function edit($id)
    {
        $question = Question::find($id);
        return view('questions.edit', compact('question'));

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $question = Question::where('id', $id)->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);
        $question_search = Question::find($id);
        $question_search->tag()->detach();
        $tags = explode(',', $request->tags);
        $tag_multi = [];
        foreach ($tags as $tag) {
            $tagAss['tag_name'] = $tag;
            $tag_multi[] = $tagAss;
        }
        //dd($tag_multi);
        foreach ($tag_multi as $tag_single) {
            $tag_save = Tag::firstOrCreate($tag_single);
            $question_search->tag()->attach($tag_save->id);
        }
        return redirect('/pertanyaan/' . $id);

    }

    public function upvote(Question $question)
    {
        $question->upvote();
        return redirect('/pertanyaan');
    }

    public function downvote(Question $question)
    {
        $downvote = $question->downvote();
        return redirect('/pertanyaan')->with('status', $downvote);
    }

    public function unvote(Question $question, $status)
    {
        $question->unvote($status);
        return redirect('/pertanyaan');

    }

    public function destroy($id, Request $request)
    {
        //dd($id);
        $delete = Question::where('id', '=', $id)->delete();
        return redirect('/pertanyaan');
    }

    public function tag($id)
    {$tag_search = Tag::find($id);
        $title = $tag_search->tag_name;
        $id_question = [];
        foreach ($tag_search->question as $idq) {
            $id_question[] = $idq->id;
        }
        $question = Question::whereIn('id', $id_question)->withCount('answers')->get();
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
        $user = User::orderBy('point', 'desc')->take(5)->get();
        $tag = Tag::all();
        return view('questions.bytag', [
            'questions' => $question,
            'tag' => $tag,
            'title' => $title,
            'user' => $user,
            // 'questions' => Question::withCount('likes')->orderBy('likes_count')->get(),
        ]);
    }
}
