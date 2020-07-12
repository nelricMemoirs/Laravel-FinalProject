<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    public function pkomentar(){
    	return $this->hasMany('App\Pkomentar');
    }

    public function jkomentar(){
        return $this->hasMany('App\Jkomentar');
    }
    public function question(){
    	return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}
