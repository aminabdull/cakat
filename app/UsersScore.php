<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersScore extends Model
{
    protected $fillable = ['username', 'gameid', 'score', 'time'];
	public $timestamps = true;
}
