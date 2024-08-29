<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Models\Article;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('articles', ArticleController::class)
//     ->only(['index'])
//     ->middleware(['auth', 'verified']);

Route::get('/articles', function () {
    // return Inertia::render('Article');
    $articles = Article::all();
    return Inertia::render('Article', [
        'articles' => $articles,
    ]);

})->middleware(['auth', 'verified'])->name('articles');

Route::get('/create', function () {
    return Inertia::render('Articles/Create');
})->middleware(['auth', 'verified'])->name('article.create');

Route::post('/article', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::get('/articlesAll', [ArticleController::class, 'getArticle'])->name('articlesAll');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
