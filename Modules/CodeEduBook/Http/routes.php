<?php

Route::group(['middleware' => ['auth', config('codeeduuser.middleware.isVerified'), 'auth.resource']], function(){
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::group(['prefix' => 'books/{book}'], function(){
       Route::resource('chapters', 'ChaptersController', ['except' => 'show']);
    });
    Route::resource('books', 'BooksController', ['except' => 'show']);
    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function (){
        Route::resource('books', 'BooksTrashedController', ['only' => ['index', 'show', 'update']]);
    });
});
