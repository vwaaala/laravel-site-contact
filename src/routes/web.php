<?php

use Illuminate\Support\Facades\Route;




Route::group(['namespace' => 'Bunker\SiteContact\Http\Controllers', 'as' => 'site-contact.'], function () {
    Route::get('contact-message', 'SiteContactController@create')->name('form');
    Route::post('contact-message-store', 'SiteContactController@store')->name('store');
});
