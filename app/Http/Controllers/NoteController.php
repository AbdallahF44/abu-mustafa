<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
    public function store(
        Request $request,
        Person $person
    ): RedirectResponse {

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'min:3',
                'max:1000',
            ],
        ]);

        $person->notes()->create([
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect()
            ->route('person.show', $person)
            ->with(
                'note_success',
                'تم إرسال الملاحظة بنجاح.'
            );
    }
}
