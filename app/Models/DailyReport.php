<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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

    public function scopeWhereReportingTime($query, $month)
    {
        if (!empty($month)) {
            return $query->where('reporting_time', 'LIKE', '%'.$month.'%');
        }
    }

    public function scopeUserReports($query, $userId)
    {
        return $query->where('user_id', $userId)->orderBy('reporting_time', 'desc');
    }
}
