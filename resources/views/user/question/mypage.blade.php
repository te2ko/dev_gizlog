@extends ('common.user')
@section ('content')

<h2 class="brand-header">
  <img src="" class="avatar-img">&nbsp;&nbsp;My page
</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-1">category</th>
          <th class="col-xs-5">title</th>
          <th class="col-xs-2">comments</th>
          <th class="col-xs-1"></th>
          <th class="col-xs-1"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questionInfos as $info)
          <tr class="row">
            <td class="col-xs-2">{{ $info->created_at->format('Y-m-d') }}</td>
            <td class="col-xs-1">{{ $info->name }}</td>
            <td class="col-xs-5">{{ $info->title }}</td>
            <td class="col-xs-2"><span class="point-color">{{ $info->count }}</span></td>
            <td class="col-xs-1">
              <a class="btn btn-success" href="{{ route('question.edit', ['id' => $info->id]) }}">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </a>
            </td>
            <td class="col-xs-1">
              {!! Form::open(['route' => ['question.destroy', $info->id]]) !!}
                <button class="btn btn-danger" type="submit">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

