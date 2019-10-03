<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\http\Controllers\controller;

class QuestionController extends Controller
{
    
    public function index()
    {
        return view('user.question.index');
    }
}
