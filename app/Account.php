<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
