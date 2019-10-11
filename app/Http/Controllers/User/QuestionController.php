<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\http\Requests\User\QuestionsRequest;
use App\http\Requests\User\CommentRequest;
use App\http\Controllers\Controller;
use App\Models\Question;
use App\Models\Comment;
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $searchId = $request->category_id;
        $word = $request->search_word;
        $categoryId = $this->category->all();
        $listInfos = $this->question->fetchQuestionForList()
                                    ->searchWord($word)
                                    ->categorySearch($searchId)
                                    ->get();
        return view('user.question.index', compact('listInfos', 'categoryId', 'word'));
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
        $input = $this->question->find($questionId);
        return view('user.question.edit', compact('input', 'questionId'));
    }

    /**
     * @param QuestionRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(QuestionsRequest $request)
    {   
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $categoryName = $this->category->find($input['tag_category_id'])->name;
        return view('user.question.confirm', compact('input', 'categoryName'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

     /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->question->find($id)->fill($input)->save();
        return redirect()->route('question.index');
    }

     /**
     * @param Request $request
     * @param int $questionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $questionId)
    {
        $user = Auth::user();
        $info = $this->question->usersQuestionInfo($questionId)
                               ->first();
        $commentInfos = $this->comment->fetchComments($questionId)
                                      ->get();
        $categoryName = $this->question->postCommentInfo($questionId)
                                       ->first();
        return view('user.question.show', compact('info', 'user', 'categoryName', 'commentInfos'));
    }

     /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function commentCreate(CommentRequest $request)
    {
        $input = $request->all();
        $this->comment->create($input);
        return redirect()->route('question.show', $input['question_id']);
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
