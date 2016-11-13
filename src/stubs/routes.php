<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application.
|
*/

Route::get('/$URL$', ['as' => '$URL$.index','uses' => 'IndexController@index']);
