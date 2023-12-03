<?php

namespace App\Services;

use App\Models\LikedNote;
use App\Models\LikedPost;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    public static function index()
    {
        $notes = Note::latest()->get();

        return $notes;
    }




    public static function store(array $data) : Note
    {
        return Note::create($data);
    }

    public static function show(Note $note)
    {

        return $note;
    }



    public static function update(Note $note, array $data)
    {

        return $note->update($data);
    }

    public static function destroy(Note $note)
    {
        return $note->delete();
    }
}
