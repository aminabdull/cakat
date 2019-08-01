<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreModel extends Model
{
    protected $fillable = ['userid', 'gameid', 'score', 'time'];
	public $timestamps = true;
}
