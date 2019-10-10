@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm']) !!}
      <div class="form-group {{ !empty($errors->first('tag_category_id')) ? 'has-error' : '' }}">
          {!! Form::select('tag_category_id', ['' => 'Select category', 1 => 'FRONT', 2 => 'BACK', 3 => 'INFRA', 4 => 'OTHERS'], !empty(old('tag_category_id')) ? old('tag_category_id') : 'Select category', ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
         <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group {{ !empty($errors->first('title')) ? 'has-error' : '' }}">
          {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'title']) !!}
          <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ !empty($errors->first('content')) ? 'has-error' : '' }}">
          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
          <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="create">
    {!! Form::close() !!}
  </div>
</div>
@endsection

