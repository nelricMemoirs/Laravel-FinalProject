<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    //
    public function jawaban(){
    	return $this->hasMany('App\Jawaban');
    }
}
