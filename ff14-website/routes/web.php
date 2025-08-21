<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\ProfilePostController;
use App\Http\Controllers\PrivateMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



// admin routes - nieuws en FAQ beheer
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    
    // FAQ beheer
    Route::get('/faq/category/create', [FaqController::class, 'createCategory'])->name('faq.create-category');
    Route::post('/faq/category', [FaqController::class, 'storeCategory'])->name('faq.store-category');
    Route::get('/faq/item/create', [FaqController::class, 'createItem'])->name('faq.create-item');
    Route::post('/faq/item', [FaqController::class, 'storeItem'])->name('faq.store-item');
    Route::delete('/faq/category/{id}', [FaqController::class, 'destroyCategory'])->name('faq.destroy-category');
    Route::delete('/faq/item/{id}', [FaqController::class, 'destroyItem'])->name('faq.destroy-item');
});

// publieke routes - iedereen kan deze zien
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::middleware(['auth'])->group(function () {
    Route::post('/news/{newsId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/promote', [\App\Http\Controllers\Admin\UserController::class, 'promote'])->name('admin.users.promote');
    Route::post('/users/{user}/demote', [\App\Http\Controllers\Admin\UserController::class, 'demote'])->name('admin.users.demote');
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');

    // contact messages admin
    Route::get('/contact', [AdminContactMessageController::class, 'index'])->name('admin.contact.index');
    Route::get('/contact/{message}', [AdminContactMessageController::class, 'show'])->name('admin.contact.show');
    Route::post('/contact/{message}/reply', [AdminContactMessageController::class, 'reply'])->name('admin.contact.reply');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // wall posts
    Route::post('/profile/{username}/post', [ProfilePostController::class, 'store'])->name('profile.post');
    Route::delete('/profile-posts/{post}', [ProfilePostController::class, 'destroy'])->name('profile.post.destroy');
    // private messages
    Route::get('/messages', [PrivateMessageController::class, 'inbox'])->name('messages.inbox');
    Route::post('/messages/{username}', [PrivateMessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/{message}/read', [PrivateMessageController::class, 'markRead'])->name('messages.read');
});

Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.public');

require __DIR__.'/auth.php';
