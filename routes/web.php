<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutUsController;

//////////////////
use App\Http\Controllers\Admin\UserController;


use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
/*dupa
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
Route::put('/about-us/update', [AboutUsController::class, 'update'])->name('about-us.update');

Route::get('/dashboard', function () {
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('blogs/', [BlogController::class, 'index'])->name('admin.blogs');
Route::delete('blog/{id}', [BlogController::class,  'destroy'])->name('admin.blog.delete');

Route::get('users/', [UserController::class, 'index'])->name('admin.user.index');
Route::get('user/{id}', [UserController::class, 'show'])->name('admin.user.show');
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('user.{id}/update', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

Route::get('/messages', [ContactController::class, 'index'])->name('messages');
Route::get('/message/{id}', [ContactController::class, 'show'])->name('message.show');
Route::get('/message/{id}/archive', [ContactController::class, 'archive'])->name('message.archive');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::delete('/message/{id}', [ContactController::class, 'destroy'])->name('message.destroy');

Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
Route::post('/files', [FileController::class, 'store'])->name('files.store');
Route::get('/files/{id}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update');
Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::resource('blogs', BlogController::class)->middleware('auth');

Route::post('/upload-avatar', [AvatarController::class, 'store'])->name('avatar.store');
Route::post('/delete-avatar/{name}', [AvatarController::class, 'destroy'])->name('avatar.destroy');


Route::get('/search', [HomeController::class, 'search'])->name('search');



Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy');


Route::post('/upload-image', function(Request $request) {
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('public/blog');
        $url = Storage::url($path);
        return response()->json(['success' => true, 'url' => $url]);
    }
    return response()->json(['success' => false]);
});



Route::get('/{blogname}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/{blogname}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');

// Trasa do wyświetlania komentarzy dla danego posta
Route::get('posts/{postId}/comments', [CommentController::class, 'index'])->name('comments.index');

// Trasa do zapisywania nowego komentarza
Route::post('posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

// Trasa do aktualizacji istniejącego komentarza
Route::put('comments/{commentId}', [CommentController::class, 'update'])->name('comments.update');

// Trasa do usuwania istniejącego komentarza
Route::delete('comments/{commentId}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('tags/{tag}', [TagController::class, 'show'])->name('tag.show');
Route::delete('/remove-tag/{tagId}', [TagController::class, 'removeTag'])->name('untag');




Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
Route::post('/files', [FileController::class, 'store'])->name('files.store');
Route::get('/files/{id}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update');
Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');