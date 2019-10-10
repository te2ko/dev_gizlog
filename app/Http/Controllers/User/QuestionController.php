<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\http\Requests\User\QuestionsRequest;
use App\http\Requests\User\CommentRequest;
use App\http\Controllers\controller;
use App\Models\Question;
use App\Models\comment;
use App\Models\TagCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    
    protected $question;
    protected $category;
    protected $comment;

    public function __construct(Question $question, TagCategory $tagCategory, Comment $comment)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->category = $tagCategory;
        $this->comment = $comment;
    }

    public function index(Request $request)
    {
        $searchId = $request->category_id;
        $word = $request->search_word;
        

        $request->session()->forget('word');

        $categoryId = $this->category->all();

        $listInfos = $this->question->fetchQuestionForList()
                                    ->searchWord($word)
                                    ->categorySearch($searchId)
                                    ->get();
    
        return view('user.question.index', compact('listInfos', 'categoryId', 'word'));
    }

    public function create()
    {
        return view('user.question.create');
    }

    public function edit($questionId)
    {
        $input = $this->question->find($questionId);

        return view('user.question.edit', compact('input', 'questionId'));
    }

    public function confirm(QuestionsRequest $request)
    {   
        $input = $request->all();

        $input['user_id'] = Auth::id();
        $categoryName = $this->category->find($input['tag_category_id'])->name;
        
        return view('user.question.confirm', compact('input', 'categoryName'));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $this->question->create($inputs);

        return redirect()->route('question.index');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->question->find($id)->fill($input)->save();

        return redirect()->route('question.index');
    }

    public function show(Request $request, $questionId)
    {
        $userId = Auth::id();

        $info = $this->question->usersQuestionInfo($questionId)
                               ->first();

        $commentInfos = $this->comment->fetchComments($questionId)
                                      ->get();

        $categoryName = $this->question->postCommentInfo($questionId)
                                       ->first();

        $avatar = Auth::user()->avatar;

        return view('user.question.show', compact('info','userId', 'categoryName', 'commentInfos', 'avatar'));
    }

    public function commentCreate(CommentRequest $request)
    {
        $input = $request->all();
        $questionId = $input['question_id'];

        $this->comment->create($input);

        return redirect()->route('question.show',$questionId);
    }

    public function myPage()
    {
        $userId = Auth::id();

        $questionInfos = $this->question
                              ->fetchMyPage($userId)
                              ->get();

        return view('user.question.mypage', compact('questionInfos'));
    }

    public function destroy($id)
    {
        $this->question->find($id)->delete();

        return redirect()->route('question.index');
    }
}
