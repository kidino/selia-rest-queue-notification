<?php

namespace App\Http\Controllers\Chinook;

use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    public function allColumns()
    {
        $tracks = Track::with('album')->get(); // retrieves all columns and all rows
        return view('chinook.track.all_columns', compact('tracks'));
    }

    public function selectedColumns()
    {
        $tracks = Track::select('id', 'name', 'milliseconds', 'bytes', 'unit_price')->get();
    
        return view('chinook.track.selected_columns', compact('tracks'));
    }
    
}
