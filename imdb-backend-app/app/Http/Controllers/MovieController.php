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
      $movies = Movie::with('genre')->paginate(10);
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
      $movie = Movie::with('genre')->find($id);
      if (!$movie){
        return response()->json(['error' => "Movie with id: $id not found"], 404);
      }
      return response()->json($movie, 200);
    }
}
