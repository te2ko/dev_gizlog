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

    public function getReportForTheMonth($month)
    {
        return where('reporting_time', 'LIKE', '%'.$month.'%')->orderBy('reporting_time', 'desc')->get();
    }
}
