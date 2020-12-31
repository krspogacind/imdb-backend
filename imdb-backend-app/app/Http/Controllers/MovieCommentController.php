<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieCommentRequest;
use App\Models\MovieComment;
use Illuminate\Support\Facades\Log;

class MovieCommentController extends Controller
{
    public function store(MovieCommentRequest $request)
    {
      $validated = $request->validated();

      $comment = new MovieComment();
      $comment->content = $validated['content'];
      $comment->user_id = auth()->user()->id;
      $comment->movie_id = $validated['movie_id'];
      $comment->save();

      $comment = MovieComment::where('id', $comment->id)->with('user')->get();

      return response()->json([
          'message' => 'Movie comment successfully created',
          'comment' => $comment], 201);
    }

    public function getCommentsByMovieId($movieId)
    {
        $movieComments = MovieComment::where('movie_id', $movieId)->with('user')->latest()->paginate(5);
        return $movieComments;
    }
}
