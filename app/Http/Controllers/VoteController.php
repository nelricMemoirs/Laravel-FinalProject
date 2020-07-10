<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
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
        if ($user) {
            $user->upVote($comment);
            return \view('UI.show')->with('pertanyaan', $comment, 'user_id', $user->id);
        }

    }
}
