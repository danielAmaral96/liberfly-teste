<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthorController,
    BookController,
    CategoryController,
    AuthController
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('library')->group(function () {
    //Rotas para User
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);

    Route::middleware('auth:api')->group(function(){
        // Rotas para Books
        Route::get('books', [BookController::class, 'index']);
        Route::get('books/{id}', [BookController::class, 'show']);
        Route::post('books', [BookController::class, 'store']);
        Route::put('books/{id}', [BookController::class, 'update']);
        Route::delete('books/{id}', [BookController::class, 'destroy']);
        Route::get('authors/{authorId}/books', [BookController::class, 'getByAuthor']);
        Route::get('categories/{categoryId}/books', [BookController::class, 'getByCategory']);

        // Rotas para Authors
        Route::get('authors', [AuthorController::class, 'index']);
        Route::get('authors/{id}', [AuthorController::class, 'show']);
        Route::post('authors', [AuthorController::class, 'store']);
        Route::put('authors/{id}', [AuthorController::class, 'update']);
        Route::delete('authors/{id}', [AuthorController::class, 'destroy']);

        // Rotas para Categories
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{id}', [CategoryController::class, 'show']);
        Route::post('categories', [CategoryController::class, 'store']);
        Route::put('categories/{id}', [CategoryController::class, 'update']);
        Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
    });

    
});