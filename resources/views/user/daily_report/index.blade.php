@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {!! Form::open(['rpute' => 'daily_report.index', 'method' => 'GET']) !!}
      {!! Form::input('month', 'month', null,['class' => 'form-control']) !!}
      {!! Form::button('<i class="fa fa-search"></i>',['class' => 'btn btn-danger', 'type' => 'submit']) !!}
    {!! Form::close() !!}
    <a class="btn btn-icon" href="{{route('daily_report.create')}}"><i class="fa fa-plus"></i></a>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($reports as $report)
          <tr class="row">
            <td class="col-xs-2">{{ $report->reporting_time->format('Y/m/d') }}</td>
            <td class="col-xs-3">{{ mb_strimwidth($report->title,0,8,"...",'UTF-8') }}</td>
            <td class="col-xs-5">{{ mb_strimwidth($report->content,0,16,"...",'UTF-8') }}</td>
            <td class="col-xs-2"><a class="btn" href="{{ route('daily_report.show', $report->id) }}"><i class="fa fa-book"></i></a></td>
          </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

