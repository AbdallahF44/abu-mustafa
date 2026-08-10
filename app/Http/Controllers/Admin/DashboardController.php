<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Person;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // إجمالي الأشخاص
        $totalPeople = Person::count();

        // عدد المنتخبين
        $electedPeople = Person::where('is_elected', true)->count();

        // عدد غير المنتخبين
        $notElectedPeople = Person::where('is_elected', false)->count();

        // إجمالي الملاحظات
        $totalNotes = Note::count();

        // الملاحظات الجديدة
        $newNotes = Note::where('status', 'new')->count();

        // آخر 5 ملاحظات
        $latestNotes = Note::with('person')
            ->latest()
            ->take(5)
            ->get();

        // آخر 8 أشخاص تمت إضافتهم
        $latestPeople = Person::latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalPeople',
            'electedPeople',
            'notElectedPeople',
            'totalNotes',
            'newNotes',
            'latestNotes',
            'latestPeople'
        ));
    }
}