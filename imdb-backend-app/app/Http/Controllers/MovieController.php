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
      $movies = Movie::with('genre')->get();
      return response()->json($movies, 200);
    }

    public function searchMovies(Request $request) {

        $validatedData = $request->validate([
          'title' => 'required|string|max:255',
        ]);

        $title = $validatedData['title'];
        $movies = Movie::with('genre')->where('title', 'LIKE', '%' . $title . '%')->paginate(10);
        return response()->json($movies, 200);
    }
}
