<?php
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
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function(){
    // Route::resource('categories', CategoryController::class);
    // Route::resource('posts', PostController::class);
    // Route::resource('tags', TagController::class);

    Route::resources([
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'tags' => TagController::class
    ]);
});

Auth::routes();



