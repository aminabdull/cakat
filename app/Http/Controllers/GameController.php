<?php

namespace App\Http\Controllers;

use App\UsersScore;
use Illuminate\Http\Request;

class GameController extends Controller
{
   public function getWord(){
      
       $client = new \GuzzleHttp\Client;
       $dataKey = $client->request('GET', 'http://random-word-api.herokuapp.com/key?', [
       'headers' => [
           'Accept'     => 'application/json',
           'Content-type' => 'application/json'
       ]
       ]);


       $data = $client->request('GET', 'http://random-word-api.herokuapp.com/word?key='.$dataKey->getBody()->getContents().'&number=4', [
       'headers' => [
           'Accept'     => 'application/json',
           'Content-type' => 'application/json'
       ]
       ]);

       $words = json_decode($data->getBody()->getContents());
       $word = strtoupper(implode(",", $words));

       return view('game', compact('word'));

   }
}