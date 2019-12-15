<?php

use Illuminate\Http\Request;

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


Route::middleware('auth:api')->group(function () {

    /* saves new book into the system */
    Route::post('store-book', 'BooksController@store');

    /* updates a book */
    Route::post('edit-book/{id}', 'BooksController@edit');

    /* deletes a book */
    Route::post('delete-book/{id}', 'BooksController@');

    /* returns single book resource with its authors */
    Route::get('get-book/{id}', 'BooksController@');

    /* returns all books and their corresponding authors */
    Route::get('get-books', 'BooksController@');

});
