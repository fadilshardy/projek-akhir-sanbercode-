<?php

namespace App\Http\Controllers;

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
        return redirect()->route('questions.index');
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {

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

    }

    public function destroy(Question $question)
    {
        $question->delete();
    }
}
