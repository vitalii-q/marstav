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
    Route::resource('/profile', App\Http\Controllers\ProfileController::class);
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile_change_password');
    Route::post('/profile/leave_сompany', [App\Http\Controllers\ProfileController::class, 'leaveCompany']);

    Route::resource('/company', App\Http\Controllers\CompaniesController::class);
    Route::post('/company/add_employee', [App\Http\Controllers\CompaniesController::class, 'addEmployeeAjax'])->name('add_employee_ajax');

    Route::post('/notification/company_invitation_success', [App\Http\Controllers\NotificationsController::class, 'companyInvitationSuccess']);
    Route::post('/notification/company_invitation_cancel', [App\Http\Controllers\NotificationsController::class, 'companyInvitationCancel']);

    // Entities
    Route::resource('/tasks', App\Http\Controllers\Entities\TasksController::class);
    Route::post('/tasks/{code}/comment', [App\Http\Controllers\Entities\TasksController::class, 'comment'])->name('task.comment');
    Route::get('/tasks/{code}/work', [App\Http\Controllers\Entities\TasksController::class, 'work'])->name('task.work');
    Route::post('/tasks/{code}/transmit', [App\Http\Controllers\Entities\TasksController::class, 'transmit'])->name('task.transmit');
    Route::post('/tasks/{code}/add_member', [App\Http\Controllers\Entities\TasksController::class, 'add_member'])->name('task.add_member');
    Route::get('/tasks/{code}/finish', [App\Http\Controllers\Entities\TasksController::class, 'finish'])->name('task.finish');

    Route::resource('/notes', App\Http\Controllers\Entities\NoteFoldersController::class, ['as' => 'note_folders']);

    Route::get('/notes/folder/{code}', [App\Http\Controllers\Entities\NotesController::class, 'index'])->name('entities.note.index');
    Route::get('/notes/folder/{code}/create', [App\Http\Controllers\Entities\NotesController::class, 'create'])->name('entities.note.create');
    Route::post('/notes/folder/{code}/store', [App\Http\Controllers\Entities\NotesController::class, 'store'])->name('entities.note.store');
    Route::post('/notes/store/ajax', [App\Http\Controllers\Entities\NotesController::class, 'ajaxStore'])->name('entities.note.store.ajax');
    Route::post('/notes/show/ajax', [App\Http\Controllers\Entities\NotesController::class, 'ajaxShow'])->name('entities.note.show.ajax');
    Route::get('/notes/folder/{folder_code}/{note_code}/edit', [App\Http\Controllers\Entities\NotesController::class, 'edit'])->name('entities.note.edit');
    Route::put('/notes/folder/{folder_code}/{note_code}/update', [App\Http\Controllers\Entities\NotesController::class, 'update'])->name('entities.note.update');
    Route::post('/notes/folder/{note_code}/update/ajax', [App\Http\Controllers\Entities\NotesController::class, 'ajaxUpdate'])->name('entities.note.update.ajax');
    Route::delete('/notes/folder/{code}', [App\Http\Controllers\Entities\NotesController::class, 'destroy'])->name('entities.note.destroy');
});


