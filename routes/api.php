<?php

use Illuminate\Support\Facades\Route;

Route::get('/subscribers', 'SubscriptionController@index')->name('api:subscribers');
Route::patch('/subscribe', 'SubscriptionController@store')->name('api:subscribe');
Route::patch('/unsubscribe', 'SubscriptionController@destroy')->name('api:unsubscribe');

Route::post('remote-mailchimp', 'RemoteSubscriptionController@store')->name('api:remote-mailchimp-change');


