<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'national_id' => [
                'required',
                'string',
                'max:50',
            ],
        ]);

        $person = Person::where(
            'national_id',
            $request->national_id
        )->first();

        if (!$person) {
            return back()
                ->withInput()
                ->with('error', 'رقم الهوية غير موجود في قاعدة البيانات.');
        }

        return view('person-result', compact('person'));
    }
}
