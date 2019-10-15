@extends ('common.user')
@section ('content')
<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['question.confirm']]) !!}
      <div class="form-group {{ !empty($errors->first('tag_category_id')) ? 'has-error' : '' }}">
      {!! Form::select('tag_category_id', ['' => 'Select category', 1 => 'FRONT', 2 => 'BACK', 3 => 'INFRA', 4 => 'OTHERS'], $editInfo->tag_category_id, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group {{ !empty($errors->first('title')) ? 'has-error' : '' }}">
        <input class="form-control" placeholder="title" name="title" type="text" value="{{ $editInfo->title }}">
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ !empty($errors->first('content')) ? 'has-error' : '' }}">
        <textarea class="form-control" placeholder="Please write down your question here..." name="content" cols="50" rows="10">{!! nl2br(e($editInfo->content)) !!}</textarea>
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <input name="questionId" type="hidden" value="{{ $questionId }}">
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
    {!! Form::close() !!}
  </div>
</div>

@endsection

