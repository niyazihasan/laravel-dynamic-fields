<?php

Route::resource('contacts', 'ContactController');
Route::post('contacts/email-exists', 'ContactController@emailExists')->name('contacts.email.exists');
Route::post('contacts/sort-table', 'ContactController@sortTable')->name('contacts.sort.table');
