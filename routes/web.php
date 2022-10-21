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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('rate');
Route::post('/settings/rates/change', [App\Http\Controllers\RatesController::class, 'changeRates']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'rate'], function () {
        Route::resource('/profile', App\Http\Controllers\ProfileController::class);
        Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile_change_password');
        Route::post('/profile/leave_сompany', [App\Http\Controllers\ProfileController::class, 'leaveCompany']);

        Route::resource('/company', App\Http\Controllers\CompaniesController::class);
        Route::post('/company/add_employee', [App\Http\Controllers\CompaniesController::class, 'addEmployeeAjax'])->name('add_employee_ajax');
        Route::post('/company/employees_check', [App\Http\Controllers\CompaniesController::class, 'employeesCountCheck']);

        Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat');
        Route::post('/chat/{code}/message', [\App\Http\Controllers\ChatController::class, 'message'])->name('message');
        Route::post('/chat/{code}/dialog', [\App\Http\Controllers\ChatController::class, 'getDialog'])->name('dialog');
        Route::post('/chat/{code}/more_messages', [\App\Http\Controllers\ChatController::class, 'moreMessages'])->name('more_messages');

        Route::post('/storage/check', [\App\Modules\Storage\Storage::class, 'checkStorage']);

        // Entities
        Route::resource('/tasks', App\Http\Controllers\Entities\TasksController::class);
        Route::post('/tasks/{code}/comment', [App\Http\Controllers\Entities\TasksController::class, 'comment'])->name('task.comment');
        Route::get('/tasks/{code}/work', [App\Http\Controllers\Entities\TasksController::class, 'work'])->name('task.work');
        Route::post('/tasks/{code}/transmit', [App\Http\Controllers\Entities\TasksController::class, 'transmit'])->name('task.transmit');
        Route::post('/tasks/{code}/add_member', [App\Http\Controllers\Entities\TasksController::class, 'add_member'])->name('task.add_member');
        Route::get('/tasks/{code}/finish', [App\Http\Controllers\Entities\TasksController::class, 'finish'])->name('task.finish');

        Route::resource('/contacts', App\Http\Controllers\Entities\ContactsController::class);
        Route::get('/contacts/{code}/show_contact', [App\Http\Controllers\Entities\ContactsController::class, 'showContact'])->name('contacts.show_contact');

        Route::get('/deals/settings', [App\Http\Controllers\Entities\DealsController::class, 'settings'])->name('deals.settings');
        Route::get('/deals/add_stage', [App\Http\Controllers\Entities\DealsController::class, 'addStage'])->name('deals.add_stage');
        Route::post('/deals/save_stages', [App\Http\Controllers\Entities\DealsController::class, 'saveStages'])->name('deals.save_stages');
        Route::delete('/deals/stage/{code}', [App\Http\Controllers\Entities\DealsController::class, 'deleteStage'])->name('deals.stage.destroy');
        Route::resource('/deals', App\Http\Controllers\Entities\DealsController::class);
        Route::post('/deals/{code}/update', [App\Http\Controllers\Entities\DealsController::class, 'update'])->name('deals_update');

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

    // settings
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/change_theme', [App\Http\Controllers\SettingsController::class, 'changeTheme']);
    Route::post('/settings/change_header_style', [App\Http\Controllers\SettingsController::class, 'changeHeaderStyle']);
    Route::post('/settings/change_header_mode', [App\Http\Controllers\SettingsController::class, 'changeHeaderMode']);
    Route::post('/settings/change_sidebar_style', [App\Http\Controllers\SettingsController::class, 'changeSidebarStyle']);

    // rates
    Route::get('/settings/rates', [App\Http\Controllers\RatesController::class, 'rates'])->name('rates');
    //Route::post('/settings/rates/change/error', [App\Http\Controllers\RatesController::class, 'changeRates']);
    //Route::post('/settings/rates/change/handle', [App\Http\Controllers\RatesController::class, 'changeRates']);

    Route::get('/stub/rate', [App\Http\Controllers\RatesController::class, 'rateStub'])->name('rate_stub');

    // notifications
    Route::post('/notification/company_invitation_success', [App\Http\Controllers\NotificationsController::class, 'companyInvitationSuccess']);
    Route::post('/notification/company_invitation_cancel', [App\Http\Controllers\NotificationsController::class, 'companyInvitationCancel']);
    Route::post('/notification/delete', [App\Http\Controllers\NotificationsController::class, 'notificationDelete']);
});


