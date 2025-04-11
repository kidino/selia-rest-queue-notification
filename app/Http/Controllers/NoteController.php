<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
{

    use AuthorizesRequests;

    public function __construct() {
        $this->authorizeResource(Note::class, 'note');
    }    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::paginate(10);
        return view('note.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => 'string|required|min:5',
            'content' => 'string|required|min:10'
        ]);

        $validated_data['user_id'] = $request->user()->id;

        Note::create($validated_data);

        return redirect(route('note.index'))->with('success', 'Note has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validated_data = $request->validate([
            'title' => 'string|required|min:5',
            'content' => 'string|required|min:10'
        ]);

        $note->update($validated_data);

        return redirect(route('note.index'))->with('success', 'Note has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
