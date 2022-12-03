<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------note/
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {

    Route::get('/', \App\Http\Livewire\Expense\HomeComponent::class)->name('expense.home');
    Route::get('/source', \App\Http\Livewire\Expense\SourceComponent::class)->name('expense.source');
    Route::get('/storage', \App\Http\Livewire\Expense\StorageComponent::class)->name('expense.storage');
    Route::get('/catgory', \App\Http\Livewire\Expense\CategoryComponent::class)->name('expense.category');


    Route::get('/note', \App\Http\Livewire\HomeComponent::class)->name('home');
    Route::get('/note/subject/{subject:id}', \App\Http\Livewire\ChapterComponent::class)->name('chapter');
    Route::get('/note/subject/{subject:id}/all', \App\Http\Livewire\AllChapterComponent::class)->name('all.chapter');
    Route::get('/note/subject/{subject:id}/chapter/{chapter:id}', \App\Http\Livewire\NoteComponent::class)->name('note');
    Route::get('/note/subject/{subject:id}/chapter/{chapter:id}/all', \App\Http\Livewire\AllNoteComponent::class)->name('all.note');
    Route::get('/note/subject/{subject:id}/chapter/{chapter:id}/note/{note:id}', \App\Http\Livewire\DescriptionComponent::class)->name('description');
    Route::get('/note/subject/{subject:id}/chapter/{chapter:id}/note/{note:id}/edit', \App\Http\Livewire\EditNoteComponent::class)->name('edit.note');
    Route::get('/profile', \App\Http\Livewire\HomeComponent::class)->name('profile');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::post('logout', LogoutController::class)->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});


Route::get('cmd/optimize', function () {Artisan::call('optimize');
    return "php artisan optimized successfully";
})->name('optimize');
Route::get('cmd/migrate', function () {Artisan::call('migrate');
    return "php artisan migrate successfully";
})->name('migrate');
Route::get('cmd/migrate-fresh', function () {Artisan::call('migrate:fresh --seed');
    return "php artisan migrate-fresh successfully";
})->name('migrate.fresh');
Route::get('cmd/migrate-rollback', function () {Artisan::call('migrate:rollback');
    return "php artisan migrate-rollback successfully";
})->name('migrate.rollback');
Route::get('cmd/db-seed', function () {Artisan::call('db:seed');
    return "php artisan db:seed successfully";
})->name('db.seed');
