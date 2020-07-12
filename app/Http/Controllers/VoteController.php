<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\User;

class VoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function vote($id)
    {
        $comment = Pertanyaan::find($id);
        $user = auth()->user();
        if ($user->hasDownVoted($comment) == true && $user->hasUpVoted($comment) == false) {
            $user->cancelVote($comment);
            $score = $comment->user->score + 1;
            $comment->user->update(['score' => $score]);
            
            return redirect()->route('pertanyaan.show', [$id])->with('success', 'down-vote canceled');
        }
        
        else if ($user->hasDownVoted($comment) == true || $user->hasUpVoted($comment) == null) {
            $user->upVote($comment);
            $score = $comment->user->score + 10;
            $comment->user->update(['score' => $score]);

            return redirect()->route('pertanyaan.show', [$id])->with('success', 'You up-voted');
        }else {
            $user->cancelVote($comment);
            $score = $comment->user->score - 10;
            $comment->user->update(['score' => $score]);
            
            // $comment->user->score -= 10;
            return redirect()->route('pertanyaan.show', [$id])->with('error', 'You canceled up-vote');
        }

    }
    public function downvote($id){
        $comment = Pertanyaan::find($id);
        $user = auth()->user();
        
        if ($user->hasDownVoted($comment) == false && $user->hasUpvoted($comment) == true) {
            $user->cancelVote($comment);
            $score = $comment->user->score - 10;
            $comment->user->update(['score' => $score]);
            
            return redirect()->route('pertanyaan.show', [$id])->with('success', 'up-vote canceled');
        }else if ($user->hasDownVoted($comment) == false){
            $user->downVote($comment);
            $score = $comment->user->score - 1;
            $comment->user->update(['score' => $score]);
            
            return redirect()->route('pertanyaan.show', [$id])->with('success', 'You down-voted');
        }else {
            $user->cancelVote($comment);
            $score = $comment->user->score + 1;
            $comment->user->update(['score' => $score]);

            return redirect()->route('pertanyaan.show', [$id])->with('error', 'You canceled down-vote');
        }
    }
    public function bestanswer($id){
        $answer = Jawaban::find($id);
        $comment = Pertanyaan::find($id);
        $user = auth()->user();
        $score = $answer->user->score + 15;
        $answer->user->update(['score' => $score]);

        $class = 'border border-success';

        $pertanyaan = $answer->question->id;
        return redirect()->route('pertanyaan.show', $answer->question->id)->with('error', 'best answer');
    }
}
