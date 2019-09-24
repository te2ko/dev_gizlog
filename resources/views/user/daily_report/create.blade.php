@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
 <div class="container">
    {!! Form::open(['route' => 'daily_report.store']) !!}
    <div class="form-group form-size-small{{ $errors->has('reporting_time') ? ' has-error' : '' }}">
      {!! Form::input('date','reporting_time', null,['required', 'class' => 'form-control']) !!}
      @if ($errors->has('reporting_time'))
        <span class="help-block">{{ $errors->first('title') }}</span>
      @endif
    </div>
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
      {!! Form::input('text','title',null,['required', 'class' => 'form-control', 'placeholder' => 'Title']) !!}
      @if ($errors->has('title'))
        <span class="help-block">{{ $errors->first('title') }}</span>
      @endif
    </div>
    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
      {!! Form::textarea('content',null,['required','class' => 'form-control','placeholder' => 'Content']) !!}
      @if ($errors->has('content'))
      <span class="help-block">{{ $errors->first('content') }}</span>
      @endif
    </div>
    {!! Form::submit('add',['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

