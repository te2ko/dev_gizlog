@extends ('common.user')
@section ('content')
<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="{{ $info->user->avatar ? $info->user->avatar : 'https://www.u-stat.net/images/site_img/pimg.png' }}" class="avatar-img">
      <p>{{ $info->user->name }}&nbsp;さんの質問&nbsp;&nbsp;({{ $categoryName->tagCategory->name }})</p>
      <p class="question-date"></p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $info->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($info->content)) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    @foreach ($commentInfos as $commentInfo)
      <div class="comment-list">
          <div class="comment-wrap">
            <div class="comment-title">
              <img src="{{ $commentInfo->user->avatar ? $commentInfo->user->avatar : 'https://www.u-stat.net/images/site_img/pimg.png' }}" class="avatar-img">
              <p>{{ $commentInfo->name }}</p>
              <p class="comment-date">{{ $commentInfo->created_at }}</p>
            </div>
            <div class="comment-body">{!! nl2br(e($commentInfo->comment)) !!}</div>
          </div>
      </div>
    @endforeach
  <div class="comment-box">
    {!! Form::open(['route' => 'question.commentcreate']) !!}
      <input name="user_id" type="hidden" value="{{ $user->id }}">
      <input name="question_id" type="hidden" value="{{ $info->id }}">
      <div class="comment-title">
        <img src="{{ $user->avatar ? $user->avatar : 'https://www.u-stat.net/images/site_img/pimg.png'}}" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body {{ !empty($errors->first('comment')) ? 'has-error' : '' }}">
        <textarea class="form-control" placeholder="Add your comment..." name="comment" cols="50" rows="10"></textarea>
        <span class="help-block">{{ $errors->first('comment') }}</span>
      </div>
      <div class="comment-bottom">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection