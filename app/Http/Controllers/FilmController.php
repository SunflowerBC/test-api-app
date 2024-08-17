<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::with('genres')->paginate(10);
        return response()->json($films);
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
    public function store(StoreFilmRequest $request)
    {
        $validationData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'genres' => 'required|array'
        ]);

        $imagePath = $validationData['image'] ? $validationData['image']->store('images') : 'default/image.jpg';

        $film = Film::create([
            'title' => $validationData['title'],
            'image_url' => $imagePath,
            'published' => false
        ]);

        $film->genres()->attach($validationData['genres']);

        return response()->json($film, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $id)
    {
       $film = Film::with('genres')->findOrFail($id);
       return response()->json($film);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, Film $id)
    {
        $validationData = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|string|url',
            'published' => 'required|boolean'
        ]);

        $film = Film::findOrFail($id);
        $film->update($validationData);

        return response()->json($film);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $id)
    {
        $film = Film::findOrFail($id);
        $film->delete();
        return response()->json(null,204);
    }
}
