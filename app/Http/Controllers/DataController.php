<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class DataController extends Controller
{
    //
    public function showAllMovie()
    {
        $movies = Movie::paginate(4);
        return view('home')->with('movies', $movies);
    }

    public function showAllGenre()
    {
        $genres = Genre::all();
        return view('insert')->with("genres", $genres);
    }

    public function insertMovie(Request $request)
    {
        $genreId = $request->input('genre');

        $movie = new Movie();
        $movie->genre_id = $genreId;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->publish_date = $request->input('publish_date');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads', 'public');
            $movie->photo = $photoPath;
        }

        $movie->save();

        return redirect()->back()->with('success', 'Movie added successfully!');
    }

    public function deleteMovie($id)
    {
        $movie = Movie::find($id);

        if ($movie) {
            $movie->delete();
            
            session()->flash('deleteSuccess', 'The movie was deleted successfully.');
        } else {
            session()->flash('deleteError', 'Movie not found.');
        }

        return redirect()->back();
    }
}
