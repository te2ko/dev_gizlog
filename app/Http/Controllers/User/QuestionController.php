<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\http\Requests\User\QuestionsRequest;
use App\http\Requests\User\CommentRequest;
use App\http\Requests\User\SearchRequest;
use App\http\Controllers\Controller;
use App\Models\Question;
use App\Models\Comment;
use App\Models\TagCategory;
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SearchRequest $request)
    {
        $searchId = $request->category_id;
        $word = $request->search_word;
        $categories = $this->category->all();
        $listInfos = $this->question->fetchQuestionForList($word, $searchId)->get();
        return view('user.question.index', compact('listInfos', 'categories', 'word', 'searchId'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.question.create');
    }

    /**
     * @param int $questionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($questionId)
    {
        $editInfo = $this->question->find($questionId);
        return view('user.question.edit', compact('editInfo', 'questionId'));
    }

    /**
     * @param QuestionRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(QuestionsRequest $request)
    {
        $confirmInfo = $request->all();
        $confirmInfo['user_id'] = Auth::id();
        $categoryName = $this->category->find($confirmInfo['tag_category_id'])->name;
        return view('user.question.confirm', compact('confirmInfo', 'categoryName'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $createInfo = $request->all();
        $this->question->create($createInfo);
        return redirect()->route('question.index');
    }

     /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $updateInfo = $request->all();
        $this->question->find($id)->fill($updateInfo)->save();
        return redirect()->route('question.index');
    }

     /**
     * @param int $questionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($questionId)
    {
        $user = Auth::user();
        $info = $this->question->find($questionId);
        $commentInfos = $this->comment->fetchComment($questionId)
                                      ->get();
        $categoryName = $this->question->fetchCategory($questionId)
                                       ->first();
                                       dd($categoryName);
        return view('user.question.show', compact('info', 'user', 'categoryName', 'commentInfos'));
    }

     /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function commentCreate(CommentRequest $request)
    {
        $createInfo = $request->all();
        $this->comment->create($createInfo);
        return redirect()->route('question.show', $createInfo['question_id']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myPage()
    {
        $userId = Auth::id();
        $questionInfos = $this->question
                              ->fetchMyPage($userId)
                              ->get();
        return view('user.question.mypage', compact('questionInfos'));
    }

     /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }
}
