<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieReactionRequest;
use App\Models\MovieReaction;

class MovieReactionController extends Controller
{
  public function store(MovieReactionRequest $request)
  {
    $validated = $request->validated();
    
    $user_id = auth()->user()->id;
    $movie_id = $validated['movie_id'];
    $reaction = MovieReaction::where('user_id', $user_id)
                              ->where('movie_id', $movie_id)
                              ->get();
    
    if ($reaction->count() !== 0){
      return response()->json(['error' => "User has already reacted to this movie"], 409);
    }

    $reaction = new MovieReaction();
    $reaction->reaction = $validated['reaction'];
    $reaction->user_id = $user_id;
    $reaction->movie_id = $movie_id;
    $reaction->save();

    return response()->json([
        'message' => 'Movie reaction successfully created',
        'reaction' => $reaction], 201);
  }
}
