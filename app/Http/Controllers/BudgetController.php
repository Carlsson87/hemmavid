<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Account;
use App\Expense;
use Carbon\Carbon;

class BudgetController extends Controller
{
    public function index()
    {
        $categories = $this->request->user()->categories;

        return view('budget', compact('categories'));
    }

    public function create($token)
    {
        $account = Account::whereToken($token)->first();

        if ( ! $account) {
            return abort(404);
        }

        $categories = $account->categories;
        $auth_token = $account->token;

        return view('add-expense', compact('categories', 'auth_token'));
    }

    public function store()
    {
        $this->validate($this->request, [
            "description" => "required",
            "category_id" => "required",
            "date" => "required",
            "cost" => "required"
        ], [
            "description.required" => "Du måste ange en beskrivning",
            "category_id.required" => "Du måste välja en kategori",
            "date.required" => "Du måste ange ett datum",
            "cost.required" => "Du måste ange en kostnad"
        ]);

        return Expense::create($this->request->only([
            'description',
            'category_id',
            'cost',
            'date',
        ]));
    }

    public function categories()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }

    public function createCategory()
    {
        $this->validate($this->request, [
            "name" => "required",
            "budget" => "required"
        ]);

        $this->request->user()->categories()->create($this->request->all());

        return redirect()->back();
    }

    public function addExpense($category_id)
    {
        $cat = Category::find($category_id);
        $exp = $cat->expenses()->create($this->request->only([
            'description',
            'category_id',
            'cost',
            'date',
        ]));

        return $cat;
    }


}
