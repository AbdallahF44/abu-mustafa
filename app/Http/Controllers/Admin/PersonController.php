<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Imports\PeopleImport;
use Maatwebsite\Excel\Facades\Excel;

class PersonController extends Controller
{

    public function index(Request $request)
    {
        $query = Person::query();

        // البحث
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('national_id', 'like', "%{$search}%");

            });
        }


        // فلترة حسب حالة الانتخاب
        if ($request->status === 'elected') {

            $query->where('is_elected', true);

        } elseif ($request->status === 'not_elected') {

            $query->where('is_elected', false);

        }


        $people = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        return view('admin.people.index', compact('people'));
    }



    public function create()
    {
        return view('admin.people.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:50|unique:people,national_id',
            'phone' => 'nullable|string|max:30',
            'is_elected' => 'nullable|boolean',
            'note' => 'nullable|string',
        ]);

        $validated['is_elected'] =
            $request->boolean('is_elected');

        Person::create($validated);

        return redirect()
            ->route('admin.people.index')
            ->with('success', 'تمت إضافة الشخص بنجاح.');
    }

    public function edit(Person $person)
    {
        return view('admin.people.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'national_id' => [
                'required',
                'string',
                'max:50',
                'unique:people,national_id,' . $person->id,
            ],

            'phone' => 'nullable|string|max:30',
            'is_elected' => 'nullable|boolean',
            'note' => 'nullable|string',
        ]);

        $validated['is_elected'] =
            $request->boolean('is_elected');

        $person->update($validated);

        return redirect()
            ->route('admin.people.index')
            ->with('success', 'تم تحديث البيانات بنجاح.');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()
            ->route('admin.people.index')
            ->with('success', 'تم حذف الشخص بنجاح.');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:5120',
            ],

            'is_elected' => [
                'required',
                'boolean',
            ],
        ]);

        Excel::import(
            new PeopleImport(
                (bool) $request->is_elected
            ),
            $request->file('file')
        );

        return redirect()
            ->route('admin.people.index')
            ->with(
                'success',
                'تم استيراد بيانات الأشخاص وتحديد حالتهم بنجاح.'
            );
    }
}
