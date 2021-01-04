<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWatchListItemRequest;
use App\Http\Requests\UpdateWatchListItemRequest;
use App\Models\UserWatchListItem;

class UserWatchListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $userId = auth()->user()->id;
      $watchlist = UserWatchListItem::where('user_id', $userId)->with('movie')->get();
      return response()->json($watchlist, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWatchListItemRequest $request)
    {
      $validated = $request->validated();
      $user_id = auth()->user()->id;

      $item = UserWatchListItem::where('user_id', $user_id)->where('movie_id', $validated['movie_id'])->get();
      if ($item->count() !== 0){
        return response()->json(['error' => "User has already added this movie to watchlist"], 409);
      }

      $newItem = new UserWatchListItem();
      $newItem->watched = $validated['watched'];
      $newItem->user_id = $user_id;
      $newItem->movie_id = $validated['movie_id'];
      $newItem->save();

      return response()->json($newItem->load('movie'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWatchListItemRequest $request, $id)
    {
      $validated = $request->validated();
      $user_id = auth()->user()->id;

      $item = UserWatchListItem::find($id);
      if ($item === null || $item->user_id !== $user_id || $item->movie_id !== $validated['movie_id']){
        return response()->json(['error' => "Movie with id: $id not in your watchlist"], 409);
      }

      $item->watched = $validated['watched'];
      $item->save();

      return response()->json($item->load('movie'), 200);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user_id = auth()->user()->id;

      $item = UserWatchListItem::find($id);
      if ($item === null || $item->user_id !== $user_id){
        return response()->json(['error' => "Movie with id: $id not in your watchlist"], 409);
      }

      $item->delete();

      return response()->json(['message' => 'Watch list item successfully deleted'], 200);
    }
}
