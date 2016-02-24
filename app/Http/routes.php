<?php

// The login page.
Route::get('login', function() {
    return view('login');
});

// Account creation.
Route::post('account', function() {
    return \App\Account::create(['token' => str_random(50)]);
});

// Login action.
Route::get('auth/{token}', function($token) {
    if ( ! \App\Account::whereToken($token)->exists()) {
        return abort(404);
    }
    return redirect('/')->withCookie(cookie()->forever('auth_token', $token));
});

// The public shortcut to adding expenses.
Route::get('add-expense/{token}', 'BudgetController@create');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'BudgetController@index');
    Route::post('add', 'BudgetController@store');
    Route::post('categories', 'BudgetController@createCategory');
    Route::post('categories/{category_id}/expenses', 'BudgetController@addExpense');
    Route::post('expenses', 'ExpenseController@store');
});
