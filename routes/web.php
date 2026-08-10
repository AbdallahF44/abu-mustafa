<?php

use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\Admin\PersonController as AdminPersonController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية - البحث
Route::get('/', [SearchController::class, 'index'])
    ->name('home');

// تنفيذ البحث
Route::post('/search', [SearchController::class, 'search'])
    ->name('search');

// عرض بيانات الشخص بعد البحث
Route::get('/person/{person}', [PersonController::class, 'show'])
    ->name('person.show');

// إرسال ملاحظة على شخص
Route::post('/person/{person}/note', [NoteController::class, 'store'])
    ->name('person.note.store');


/*
|--------------------------------------------------------------------------
| User Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', function () {
            return app(
                \App\Http\Controllers\Admin\DashboardController::class
            )->index();
        })->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | People
        |--------------------------------------------------------------------------
        */

        // Import Excel
        // مهم: يجب أن يكون قبل resource
        Route::post(
            '/people/import',
            [AdminPersonController::class, 'import']
        )->name('people.import');

        // CRUD للأشخاص
        Route::resource('people', AdminPersonController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Notes
        |--------------------------------------------------------------------------
        */

        // قائمة الملاحظات
        Route::get(
            '/notes',
            [AdminNoteController::class, 'index']
        )->name('notes.index');

        // تعليم الملاحظة كمراجعة
        Route::patch(
            '/notes/{note}/review',
            [AdminNoteController::class, 'review']
        )->name('notes.review');

        // حذف الملاحظة
        Route::delete(
            '/notes/{note}',
            [AdminNoteController::class, 'destroy']
        )->name('notes.destroy');
    });


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
