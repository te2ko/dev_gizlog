@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問一覧</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'question.index','class' => 'categoryFrom', 'method' => 'GET']) !!}
    <div class="btn-wrapper">
      <div class="search-box">
      {!! Form::text('search_word', isset($word) ? $word : null, ['class' => 'form-control search-form', 'placeholder' => 'Search words...']) !!}
      {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'search-icon', 'type' => 'submit']) !!}
      </div>
      <a class="btn" href="{{ route('question.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
      <a class="btn" href="{{ route('question.mypage') }}">
        <i class="fa fa-user" aria-hidden="true"></i>
      </a>
      @if (!empty($errors->first('category_id')))
      <div class="{{ !empty($errors->first('category_id')) ? 'has-error' : '' }}">
        <span class="help-block">{{ $errors->first('category_id') }}</span>
      </div>
      @endif
    </div>
    <div class="category-wrap">
      <button class="btn all {{ empty($searchId) ? 'selected' : '' }}" id="0">All</button>
      @foreach ($categories as $category)
        <button class="btn {{ $category->name }}@if(!empty($searchId) && $searchId == $category->id) selected @else '' @endif" id="{{ $category->id }}">{{ $category->name }}</button>
      @endforeach
      <input type="hidden" name="category_id" value="" id="category-val">
    </div>
  {!! Form::close() !!}  
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">user</th>
          <th class="col-xs-2">category</th>
          <th class="col-xs-6">title</th>
          <th class="col-xs-1">comments</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($listInfos as $listInfo)
        <tr class="row">
          <td class="col-xs-1"><img src="{{ $listInfo->avatar ? $listInfo->avatar : 'https://www.u-stat.net/images/site_img/pimg.png' }}" class="avatar-img"></td>
          <td class="col-xs-2">{{ $listInfo->name }}</td>
          <td class="col-xs-6">{{ mb_strimwidth($listInfo->title, 0, 15, '...', 'UTF-8') }}</td>
          <td class="col-xs-1"><span class="point-color">{{ $listInfo->count }}</span></td>
          <td class="col-xs-2">
            <a class="btn btn-success" href="{{ route('question.show', $listInfo->id) }}">
              <i class="fa fa-comments-o" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center"></div>
  </div>
</div>

@endsection

