<?php

Route::resource('contacts', 'ContactController');
Route::post('email-exists', 'ContactController@emailExists')->name('email.exists');
