<?php

use Illuminate\Support\Facades\Route;




Route::group(['namespace' => 'Bunker\SiteContact\Http\Controllers', 'middleware' => 'web', 'as' => 'support-ticket.'], function () {
    Route::get('contact-message', 'TicketController@create')->name('form');
    Route::post('contact-message-store', 'TicketController@store')->name('store');
});

Route::group(['namespace' => 'Bunker\SiteContact\Http\Controllers', 'middleware' => ['auth', 'web'], 'as' => 'support-ticket.'], function () {
    // Index route
    Route::get('contact-messages/index', 'TicketController@index')->name('index');

    // Update route
    Route::put('contact-message/{id}', 'TicketController@update')->name('update');
});

