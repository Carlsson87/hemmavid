<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Expense;
use App\Category;

class ExpenseController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('add-expense', compact('categories'));
    }

    public function store()
    {
        $this->validate($this->request, [
            'description' => 'required',
            'category_id' => 'required',
            'cost' => 'required',
            'date' => 'required'
        ]);
        return Expense::create($this->request->all());
    }


}
