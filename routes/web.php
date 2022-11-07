<?php

use Illuminate\Support\Facades\Auth;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/blog/posts/{post}', [\App\Http\Controllers\Blog\PostController::class, 'show'])->name('blog.show');
Route::get('/blog/categories/{category}', [\App\Http\Controllers\Blog\PostController::class, 'category'])->name('blog.category');
Route::get('/blog/tags/{tag}', [\App\Http\Controllers\Blog\PostController::class, 'tag'])->name('blog.tag');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);

    Route::resource('tags', \App\Http\Controllers\TagsController::class);

    Route::resource('posts', \App\Http\Controllers\PostsController::class);

    Route::get('trashed-posts', [\App\Http\Controllers\PostsController::class, 'trashed'])->name('trashed-posts.index');

    Route::put('restore-post/{post}', [\App\Http\Controllers\PostsController::class, 'restore'])->name('restore-posts');

});

route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
    Route::get('users/edit', [\App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit-profile');
    Route::put('users/update', [\App\Http\Controllers\UsersController::class, 'update'])->name('users.update-profile');
    route::post('users/{user}/make-admin', [\App\Http\Controllers\UsersController::class, 'makeAdmin'])->name('users.make-admin');
});
