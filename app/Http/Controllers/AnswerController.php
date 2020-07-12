<?php

namespace App\Http\Controllers;

use App\Answer;
use App\User;
use App\Comment_Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $answer = Answer::Where('question_id', '=', $id)->get();
        return view('question.index', compact('answer'));
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
            'content' => $request['content'],
            'question_id' => $request['question_id'],
            'user_id' => Auth::user()->id,
            'is_right_answer' => 0,
        ]);
        return redirect('/pertanyaan/' . $request['question_id'])->with('status', 'Komentar berhasil dibuat!');
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
        return view('answers.edit', compact('answer'));
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
        $answer = Answer::Where('id', '=', $id)->update([
            'content' => $request['content'],
        ]);
        //dd($request['question_id']);
        return redirect('/pertanyaan/' . $request['question_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        //dd($request->all());
        $answer = Answer::destroy($id);
        return redirect('/pertanyaan/' . $request['question_id']);
    }
    public function right($id, Request $request)
    {
        //dd($request->all());
        $cek = Answer::find($id);
        //dd();
        $user = User::find($cek->user_id);

        if($cek->user_id !=Auth::user()->id){
        if ($cek->is_right_answer == 0) {
            $update_point = User::where('id', '=', $cek->user_id)->update([
                'point' => $user->point + 15,
            ]);
        } else {
            $update_point = User::where('id', '=', $cek->user_id)->update([
                'point' => $user->point - 15,
            ]);
        }
    }
        $answer = Answer::Where('id', '=', $id)->update([
            'is_right_answer' => $request['is_right_answer'],
            'updated_at' => $cek->updated_at,
        ]);
        return redirect('/pertanyaan/' . $request['question_id']);
    }

    public function upvote(Answer $answer)
    {
        $answer->upvote();
        return redirect('pertanyaan/' . $answer->question_id);
    }

    public function downvote(Answer $answer)
    {
        $downvote = $answer->downvote();
        return redirect('pertanyaan/' . $answer->question_id)->with('error', $downvote);
    }

    public function unvote(Answer $answer, $status)
    {
        $answer->unvote($status);
        return redirect('pertanyaan/' . $answer->question_id);
    }
    public function delete_comment($id,Request $request){
        //dd($id);
        $del = Comment_Answer::where('id','=', $id)->delete();
        return redirect('/pertanyaan/'.$request['question_id']);
    }
}
