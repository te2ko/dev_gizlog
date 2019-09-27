<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reporting_time',
        'title',
        'content',
        'user_id',
    ];
    
    protected $dates = [
        'reporting_time',
        'deleted_at,'
    ];

    public function scopegetSelectReports($query, $month)
    {
        if (!empty($month)) {
            return $query->where('reporting_time', 'LIKE', '%'.$month.'%');
        }
    }

    public function scopegetreports($query)
    {
        return $query->where('user_id', Auth::id())->orderBy('reporting_time', 'desc');
    }
}
