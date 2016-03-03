<?php

use App\Account;

// The login page.
Route::get('login', function() {
    return view('login');
});

// Account creation.
Route::post('account', function() {
    return Account::create(['token' => str_random(50)]);
});

// Login action.
Route::get('auth/{token}', function($token) {

    // Check if the account exists.
    if ( ! Account::whereToken($token)->exists()) {
        return abort(404);
    }

    // Set The Cookie™
    $cookie = cookie()->forever('auth_token', $token);

    // Redirect to the home screen.
    return redirect('/')->withCookie($cookie);
});

// The public shortcut to adding expenses.
Route::get('add-expense/{token}', function($token) { 

    // Find the account.
    $account = Account::whereToken($token)->first();

    // Abort if the account doesn't exist.
    if ( ! $account) {
        return abort(404);
    }

    return view('add-expense', [
        'categories' => $account->categories,
        'auth_token' => $token
    ]);
});

// The public list address. 
Route::get('list/{token}', function($token) { 

    // Find the account.
    $account = Account::whereToken($token)->first();

    // Abort if the account doesn't exist.
    if ( ! $account) {
        return abort(404);
    }

    return view('public-list', [
        'items' => $account->items,
        'auth_token' => $token
    ]);
});

Route::post('create-item/{token}', function(\Illuminate\Http\Request $req, $token) {
    // Find the account.
    $account = Account::whereToken($token)->first();

    // Abort if the account doesn't exist.
    if ( ! $account) {
        return abort(404);
    }

    // Create the item.
    $item = $account->items()->create(['text' => $req->get('text'), 'checked' => false]);

    $data_string = json_encode([
        "room" => $account->token,
        "event" => "create.item",
        "payload" => $item->toArray()
    ]);
                                                                                                                         
    $ch = curl_init('http://localhost:8001');                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   
                                                                                                                         
    $result = curl_exec($ch);

    return response(null, 200);
});

// The protected routes.
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'BudgetController@index');
    Route::post('add', 'BudgetController@store');
    Route::post('categories', 'BudgetController@createCategory');
    Route::post('categories/{category_id}/expenses', 'BudgetController@addExpense');
    Route::post('expenses', 'ExpenseController@store');
});
