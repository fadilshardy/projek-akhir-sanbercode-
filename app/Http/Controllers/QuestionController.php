<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment_Answer;
use App\Comment_Question;
use App\Question;
use App\Tag;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {

        $question = Question::withCount('answers')->get();
        $question = $question->sortByDesc(function ($question) {
            return $question->votes->sum('voted');
        });
        $tag = Tag::all();
        return view('questions.index', [
            'questions' => $question,
            'tag'=>$tag,
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
            'content' => 'required|max:255',
        ]);

        $question = Question::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],

        ]);
        //create tag Baru
        $tags = explode(',', $request->tags);
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
        $question = Question::find($id);
        $answer = Answer::where('question_id', '=', $id)->orderBy('is_right_answer', 'desc')->get();
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
            'content' => 'required|max:255',
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
        return redirect('/pertanyaan');

    }

    public function upvote(Question $question)
    {
        $question->upvote();
        return redirect('/pertanyaan');
    }

    public function downvote(Question $question)
    {
        $question->downvote();
        return redirect('/pertanyaan');
    }

    public function unvote(Question $question, $status)
    {
        $question->unvote($status);
        return redirect('/pertanyaan');

    }

    public function destroy(Question $question)
    {
        $question->delete();
    }
    public function tag($id)
    {   $tag_search = Tag::find($id);
        $title=$tag_search->tag_name;
        $id_question=[];
        foreach ($tag_search->question as $idq){
            $id_question[] = $idq->id;
        }
        $question = Question::whereIn('id', $id_question)->withCount('answers')->get();
        $question = $question->sortByDesc(function ($question) {
            return $question->votes->sum('voted');
        });
        $tag = Tag::all();
        return view('questions.bytag', [
            'questions' => $question,
            'tag'=>$tag,
            'title'=>$title,
            // 'questions' => Question::withCount('likes')->orderBy('likes_count')->get(),
        ]);
    }
}
