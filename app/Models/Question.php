<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'tag_category_id',
        'title',
        'content',
        'user_id',
    ];

    public function scopeUsersQuestionInfo($query, $questionId)
    {
        return $query->join('users', 'questions.user_id', '=', 'users.id')
                     ->where('questions.id', '=', $questionId)
                     ->select('users.name', 'users.avatar', 'questions.title', 'questions.content', 'questions.id as question_id');
    }
    
    public function scopePostCommentInfo($query, $questionId)
    {
        return $query->join('tag_categories', 'questions.tag_category_id', '=', 'tag_categories.id')
                     ->select('tag_categories.name')
                     ->where('questions.id', '=', $questionId);
    }

    public function scopeFetchMyPage($query, $userId)
    {
        return $query->leftjoin('comments', 'questions.id', '=', 'comments.question_id')
                     ->leftjoin('tag_categories', 'questions.tag_category_id', '=', 'tag_categories.id')
                     ->select(DB::raw('count(comments.question_id) as count'), 'questions.id', 'questions.title', 'questions.user_id', 'questions.created_at', 'tag_categories.name')
                     ->where('questions.user_id', '=', $userId)
                     ->groupBy('comments.question_id', 'questions.id', 'questions.title', 'questions.user_id', 'questions.created_at', 'tag_categories.name')
                     ->orderby('created_at', 'asc');
    }

    public function scopeFetchQuestionForList($query, $word, $searchId)
    {
        return $query->join('users as u', 'questions.user_id', '=', 'u.id')
                     ->join('tag_categories as t', 'questions.tag_category_id', '=', 't.id')
                     ->leftjoin('comments as c', 'questions.id', '=', 'c.question_id')
                     ->select(DB::raw('count(c.question_id) as count'), 'u.avatar', 't.name', 'questions.title', 'questions.id', 'questions.created_at')
                     ->groupBy('c.question_id', 'u.avatar', 't.name', 'questions.title', 'questions.id', 'questions.created_at')
                     ->orderby('created_at', 'desc')
                     ->searchWord($word)
                     ->categorySearch($searchId);
    }

    public function scopeCategorySearch($query, $id)
    {
       if (isset($id)) {
           return $query->where('t.id', '=', $id);
       }
    }

    public function scopeSearchWord($query, $word)
    {
        if (isset($word)) {
            return $query->where('questions.title', 'LIKE', '%'.$word.'%');
        }
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFetchCategory($query, $questionId)
    {
        return $query->where('id', $questionId);
    }

}
