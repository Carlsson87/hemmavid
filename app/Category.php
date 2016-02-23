<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{

    protected $guarded = [];

    protected $appends = [
        "current_total",
        "current_percentage"
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function getCurrentTotalAttribute()
    {
        $day = Carbon::create(null, null, 25);

        if ($day->isPast()) {
            $start = $day;
            $end = $day->copy()->addMonth();
        } else {
            $start = $day->copy()->subMonth();
            $end = $day;
        }

        return $this->expenses()->whereBetween('date', [$start, $end])->sum('cost');
    }

    public function getCurrentPercentageAttribute()
    {
        $budget = (float) $this->getAttribute('budget');
        $total = (float) $this->getAttribute('current_total');

        return ($total / $budget) * 100;
    }


}
