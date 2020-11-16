<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    private $rules = [
        'name' => 'required|max:255',
        'is_active => boolean'
    ];

    public function index()
    {
        return Genre::all();
    }
 
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Genre $genre)
    {
        //
    }

    public function edit(Genre $genre)
    {
        //
    }

   
    public function update(Request $request, Genre $genre)
    {
        //
    }

    public function destroy(Genre $genre)
    {
        //
    }
}
