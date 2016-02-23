<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'BudgetController@index');
    Route::get('add-expense/{token}', 'BudgetController@create');
    Route::post('add', 'BudgetController@store');
    Route::get('categories', 'BudgetController@categories');
    Route::post('categories', 'BudgetController@createCategory');
    Route::post('categories/{category_id}/expenses', 'BudgetController@addExpense');
    Route::post('expenses', 'ExpenseController@store');
});
