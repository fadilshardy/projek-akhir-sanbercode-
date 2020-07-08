<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
Use Illuminate\Support\Facades\Auth;
class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $answer = Answer::Where('question_id','=',$id)->get();
        return view('question.index',compact('answer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //
        $answer = Answer::create([
            'content'=>$request['content'],
            'question_id'=>$request['question_id'],
            'user_id' =>Auth::user()->id
        ]);
        return redirect('/pertanyaan/'.$request['question_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $answer = Answer::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $answer = Answer::find($id);
        return view('answer.edit',compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $answer=Answer::Where('id','=',$id)->update([
            'title' =>$request['title'],
            'content' =>$request['content'],
        ]);
        return redirect('/answer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
        //dd($request->all());
        $answer=Answer::destroy($id);
        return redirect('/pertanyaan/'.$request['question_id']);
    }
}
