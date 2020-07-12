<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jcc\LaravelVote\CanBeVoted;

class Pertanyaan extends Model
{
    use CanBeVoted;

    protected $vote = User::class;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    //
    public function jawaban(){
    	return $this->hasMany('App\Jawaban');
    }

    public function pkomentar(){
    	return $this->hasMany('App\Pkomentar');
    }

}
