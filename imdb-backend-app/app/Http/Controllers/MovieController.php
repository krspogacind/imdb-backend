<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $movies = Movie::with('genre')->with('reactions')->paginate(10);
      return response()->json($movies, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDoItem  $toDoItem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $movie = Movie::with('genre')->with('reactions')->find($id);
      if (!$movie){
        return response()->json(['error' => "Movie with id: $id not found"], 404);
      }
      return response()->json($movie, 200);
    }

    public function searchMovies(Request $request) 
    {
      $validatedData = $request->validate([
        'title' => 'required|string|max:255',
      ]);

      $title = $validatedData['title'];
      $movies = Movie::with('genre')->with('reactions')->where('title', 'LIKE', '%' . $title . '%')->paginate(10);
      return response()->json($movies, 200);
    }

    public function updateMovieCount($id)
    {
      $movie = Movie::find($id);
      if (!$movie){
        return response()->json(['error' => "Movie with id: $id not found"], 404);
      }
      $movie->view_count = $movie->view_count + 1;
      $movie->save();
      return response()->json($movie, 200);
    }

    public function filterMovies(Request $request) 
    {
      $validatedData = $request->validate([
        'genre_id' => 'required|integer',
      ]);

      $genre = $validatedData['genre_id'];
      $movies = Movie::with('genre')->with('reactions')->where('genre_id', $genre)->paginate(10);
      return response()->json($movies, 200);
    }
}
