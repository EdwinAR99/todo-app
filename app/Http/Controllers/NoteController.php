<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Tag;
use Inertia\Response;

class NoteController extends Controller
{
    const NUMBER_OF_ITEMS_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::paginate(self::NUMBER_OF_ITEMS_PER_PAGE);
        return inertia('Notes/Index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return inertia('Notes/Create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        Note::create($request->validated());
        return redirect()->route('notes.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notes = Note::where('user_id', '=', $id)->paginate(self::NUMBER_OF_ITEMS_PER_PAGE);

        // Devuelve una respuesta JSON si la petición es AJAX
        if (request()->expectsJson()) {
            return response()->json(['notes' => $notes]);
        }

        return inertia('Notes/Index', ['notes' => $notes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $tags = Tag::all();
        return inertia('Notes/Edit', ['note' => $note, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        $note->update($request->validated());
        return redirect()->route('notes.show', $note->user_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $user_id = $note->user_id;
        $note->delete();
        return redirect()->route('notes.show', $user_id);
    }
}
