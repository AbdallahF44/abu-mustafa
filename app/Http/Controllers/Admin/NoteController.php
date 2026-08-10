<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
    public function index(): View
    {
        $notes = Note::with('person')
            ->latest()
            ->paginate(15);

        $newNotes = Note::where(
            'status',
            'new'
        )->count();

        return view(
            'admin.notes.index',
            compact(
                'notes',
                'newNotes'
            )
        );
    }

    public function review(
        Note $note
    ): RedirectResponse {

        $note->update([
            'status' => 'reviewed',
        ]);

        return back()->with(
            'success',
            'تمت مراجعة الملاحظة.'
        );
    }

    public function destroy(
        Note $note
    ): RedirectResponse {

        $note->delete();

        return back()->with(
            'success',
            'تم حذف الملاحظة.'
        );
    }
}
