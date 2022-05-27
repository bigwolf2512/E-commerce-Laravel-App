<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Product\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('buyers', Buyer\BuyerController::class, ['except' => ['create', 'edit']]);

Route::resource('carts', Cart\CartController::class, ['except' => ['create', 'edit']]);

Route::resource('sellers', Seller\SellerController::class, ['only' => ['index', 'show']]);

Route::resource('transactions', Transaction\TransactionController::class, ['except' => ['create', 'edit']]);
Route::delete('transactions-remove', [Transaction\TransactionController::class, 'removeTransactions']);

Route::resource('products', Product\ProductController::class, ['except' => ['create', 'edit']]);
Route::get('productsbycategory/{id}', [Product\ProductController::class, 'getProductByCategories']);

Route::resource('categories', Category\CategoryController::class, ['except' => ['create', 'edit']]);

Route::resource('users', User\UserController::class, ['except' => ['create', 'edit']]);

Route::post('auth/register', [AuthController::class, 'register']);

Route::post('auth/login', [AuthController::class, 'login']);
