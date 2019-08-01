<?php

namespace App\Http\Controllers;

use App\UsersScore;
use Illuminate\Http\Request;

class Score extends Controller
{
   public function post(Request $request){
      
    $score = UsersScore::create($request->all());

      $response = array(
          'status' => 'success',
          'msg' => 'Data has been saved',
      );
      return response()->json($response);

   }
}