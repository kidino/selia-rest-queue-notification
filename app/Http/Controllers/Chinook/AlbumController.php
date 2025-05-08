<?php

namespace App\Http\Controllers\Chinook;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index1()
    {
        $albums = Album::all();

        return view('chinook.album.index1', compact('albums'));
    }

    public function index2()
    {
        $albums = Album::withCount('tracks') // Uses SQL COUNT
        ->withSum('tracks', 'milliseconds') // Uses SQL SUM
        ->withSum('tracks', 'bytes') // Uses SQL SUM
        ->get();

        return view('chinook.album.index2', compact('albums'));
    }    

    public function index3()
    {
        $albums = Album::withCount('tracks') // Uses SQL COUNT
        ->withSum('tracks', 'milliseconds') // Uses SQL SUM
        ->withSum('tracks', 'bytes') // Uses SQL SUM
        ->paginate(10);

        return view('chinook.album.index3', compact('albums'));
    }    



}
