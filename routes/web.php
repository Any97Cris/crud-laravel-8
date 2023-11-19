<?php

use App\Http\Controllers\{ PostController };
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::any('/posts/search', [PostController::class, 'search'])->name('post.search');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::put('/posts/update/{id}',[PostController::class, 'update'])->name('post.update');
    Route::get('/posts/edit/{id}',[PostController::class, 'edit'])->name('post.edit');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('post.delete');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';