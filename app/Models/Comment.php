<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'comment'
    ];

    public function scopeFetchComments($query, $questionId)
    {
        return $query->join('users', 'comments.user_id', '=', 'users.id')
                     ->join('questions', 'comments.question_id', '=', 'questions.id')
                     ->where('questions.id', '=', $questionId)
                     ->select('users.name', 'users.avatar', 'comments.comment', 'comments.created_at')
                     ->orderBy('comments.created_at', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function scopeFetchComment($query, $questionId)
    {
        return $query->where('question_id', $questionId)
                     ->with(['question', 'user']);
    }
}