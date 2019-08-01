<?php

namespace App\Http\Controllers;

use DB;
use App\UsersScore;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $score = DB::table('users_scores')->select('*')->orderBy('score', 'desc')->orderBy('time', 'asc')->get();
        return view('home', compact('score'));
    }
}
