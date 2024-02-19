<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "user"], function () {
    Route::post('login', "UserController@login");
    Route::post('auth', "UserController@auth");

    Route::group(['prefix' => "wedding"], function () {
        Route::group(['prefix' => "{id}"], function () {
            Route::group(['prefix' => "guest"], function () {
                Route::post('store', "GuestController@store");
                Route::post('delete', "GuestController@delete");
                Route::get('/', "WeddingController@guest");
            });
            Route::group(['prefix' => "greetings"], function () {
                Route::post('delete', "GreetingController@delete");
                Route::get('/', "WeddingController@greetings");
            });

            Route::group(['prefix' => "schedule"], function () {
                Route::post('store', "ScheduleController@store");
                Route::post('update', "ScheduleController@update");
                Route::post('delete', "ScheduleController@delete");
                Route::get('/', "WeddingController@schedule");
            });

            Route::group(['prefix' => "gallery"], function () {
                Route::post('store', "GalleryController@store");
                Route::post('delete', "GalleryController@delete");
                Route::post('update', "GalleryController@update");
                Route::get('/', "WeddingController@gallery");
            });

            Route::post('settings', "WeddingController@saveSettings");
        });
        Route::post('create', "WeddingController@create");
        Route::get('/', "UserController@wedding");
    });
});

// Route::get('wedding/{slug}', "WeddingController@getBySlug");
Route::group(['prefix' => "wedding/{slug}"], function () {
    Route::post('greeting', "GreetingController@store");
    Route::post('reservation', "ReservationController@reserve");
    Route::get('/', "WeddingController@getBySlug");
});