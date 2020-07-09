<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

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

        Question::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],

        ]);
        return redirect()->route('pertanyaan.index');
    }

    public function show($id)
    {
        $question = Question::find($id);
        $answer = Answer::where('question_id', '=', $id)->get();
        //dd($answer);
        return view('questions.show', compact('question', 'answer'));
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

        Question::where('id', $id)->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);
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
