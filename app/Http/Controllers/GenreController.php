<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $validationData = $request->validate([
            'title' => 'required|string'
        ]);
        $genre = Genre::create($validationData);
        return response()->json($genre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json($genre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $id)
    {
        $validationData = $request->validate([
            'title' => 'required|string'
        ]);
        $genre = Genre::findOrFail($id);
        $genre->update($validationData);

        return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return response()->json(null, 204);
    }
}
