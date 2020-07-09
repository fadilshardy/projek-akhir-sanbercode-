<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Tag;
use App\Comment_Question;
class QuestionController extends Controller
{
    public function index()
    {
        return view('questions.index', [
            'questions' => Question::all(),
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
        $tags = explode(',',$request->tags);
        $tag_multi = [];
        foreach($tags as$tag){
            $tagAss['tag_name'] = $tag;
            $tag_multi[] = $tagAss;
        }
        //dd($tag_multi);
        foreach ($tag_multi as $tag_single){
            $tag_save = Tag::firstOrCreate($tag_single);
            $question->tag()->attach($tag_save->id);
        }
        //dd($tag_save);
        return redirect()->route('pertanyaan.index');
    }

    public function show($id)
    {
        $question = Question::find($id);
        $answer= Answer::where('question_id','=',$id)->orderBy('is_right_answer', 'desc')->get();
        $commentq= Comment_Question::where('question_id','=',$id)->get();
        //dd($comment_question);
        return view('questions.show', compact('question','answer','commentq'));
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
        $tags = explode(',',$request->tags);
        $tag_multi = [];
        foreach($tags as$tag){
            $tagAss['tag_name'] = $tag;
            $tag_multi[] = $tagAss;
        }
        //dd($tag_multi);
        foreach ($tag_multi as $tag_single){
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

    public function unvote(Question $question, $vote)
    {
        $question->unvote($vote);
        return redirect('/pertanyaan');

    }

    public function destroy(Question $question)
    {
        $question->delete();
    }
}
