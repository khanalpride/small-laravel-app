<?php

Route::auth();

Route::get('/', [
  'as' => 'home',
  'uses' => 'HomeController@dashboard'
]);

Route::get('about', [
  'as' => 'about',
  'uses' => 'HomeController@about'
]);

Route::get('transactions', [
  'as' => 'transactions',
  'uses' => 'TransactionController@index'
]);

Route::post('getLoan', [
  'as' => 'getloan',
  'uses' => 'TransactionController@getLoan'
]);

Route::post('payLoan', [
  'as' => 'payloan',
  'uses' => 'TransactionController@payLoan'
]);

Route::get('/loan/{transaction}/approve', [
  'as' => 'approveloan',
  'uses' => 'TransactionController@approve'
]);

Route::get('/loan/{transaction}/delete', [
  'as' => 'deleteloan',
  'uses' => 'TransactionController@delete'
]);

