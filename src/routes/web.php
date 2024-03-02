<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Bunker\SupportTicket\Http\Controllers', 'middleware' => ['auth', 'web'], 'as' => 'support_ticket.'], function () {
    Route::get('contact-messages/index', 'TicketController@index')->name('index');
    Route::get('contact-messages/create', 'TicketController@create')->name('create');
    Route::post('contact-messages/store', 'TicketController@store')->name('store');
    Route::get('contact-messages/{uuid}/show', 'TicketController@show')->name('show');
    Route::get('contact-messages/{uuid}/edit', 'TicketController@edit')->name('edit');
    Route::put('contact-messages/{uuid}', 'TicketController@update')->name('update');
    Route::get('contact-messages/{uuid}/destroy', 'TicketController@destroy')->name('destroy');
    Route::post('contact-messages/{uuid}/reply', 'TicketController@postReply')->name('postReply');
    Route::post('contact-messages/{uuid}/close', 'TicketController@closeReply')->name('closeReply');
    Route::post('contact-messages/{uuid}/reopen', 'TicketController@reOpenReply')->name('reOpenReply');
});

