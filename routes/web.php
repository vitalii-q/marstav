<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    // Entities
    Route::resource('/notes', App\Http\Controllers\Entities\NoteFoldersController::class, ['as' => 'note_folders']);

    Route::get('/notes/folder/{code}', [App\Http\Controllers\Entities\NotesController::class, 'index'])->name('entities.note.index');
    Route::get('/notes/folder/{code}/create', [App\Http\Controllers\Entities\NotesController::class, 'create'])->name('entities.note.create');
    Route::post('/notes/folder/{code}/store', [App\Http\Controllers\Entities\NotesController::class, 'store'])->name('entities.note.store');
    Route::get('/notes/folder/{folder_code}/{note_code}/edit', [App\Http\Controllers\Entities\NotesController::class, 'edit'])->name('entities.note.edit');
    Route::put('/notes/folder/{folder_code}/{note_code}/update', [App\Http\Controllers\Entities\NotesController::class, 'update'])->name('entities.note.update');
    Route::post('/notes/folder/{note_code}/update/ajax', [App\Http\Controllers\Entities\NotesController::class, 'ajaxUpdate'])->name('entities.note.update.ajax');
    Route::delete('/notes/folder/{code}', [App\Http\Controllers\Entities\NotesController::class, 'destroy'])->name('entities.note.destroy');
});


