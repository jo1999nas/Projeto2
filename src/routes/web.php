<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Perfil e posts do usuário
Route::get('/{account:name}', [AccountController::class, 'show'])->name('account.show');

// Ações de seguir/deixar de seguir
Route::post('/{account:name}/follow', [FollowController::class, 'store'])->name('accounts.follow')->middleware('auth');
Route::delete('/{account:name}/unfollow', [FollowController::class, 'destroy'])->name('accounts.unfollow')->middleware('auth');

// Listas de seguidores/seguindo
Route::get('/{account:name}/followers', [AccountController::class, 'followers'])->name('accounts.followers')->middleware('auth');
Route::get('/{account:name}/following', [AccountController::class, 'following'])->name('accounts.following')->middleware('auth');

// Rotas para postagens
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

// Rota do feed de postagens
Route::get('/', [FeedController::class, 'index'])->name('feed.index');

// Rota para salvar um novo comentário em um post específico
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

// Rota para apagar um comentário (não precisa ser aninhada)
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');