<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Expense;
use Carbon\Carbon;

class BudgetController extends Controller
{
    public function index()
    {
        $categories = $this->request->user()->categories;

        return view('budget', compact('categories'));
    }

    public function create()
    {
        $categories = $this->request->user()->categories;
        $auth_token = $this->request->user()->token;

        return view('add-expense', compact('categories', 'auth_token'));
    }

    public function store()
    {
        $this->validate($this->request, [
            "description" => "required",
            "category_id" => "required",
            "date" => "required",
            "cost" => "required"
        ]);

        return Expense::create($this->request->all());
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

        return redirect('categories');
    }

    public function addExpense($category_id)
    {
        $cat = Category::find($category_id);
        $exp = $cat->expenses()->create($this->request->all());

        return $cat;
    }


}
