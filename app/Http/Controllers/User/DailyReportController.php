<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\User\DailyReportRequest;

class DailyReportController extends Controller
{
    private $instance;

    public function __construct(DailyReport $dailyReportInstance)
    {
        $this->middleware('auth');
        $this->instance = $dailyReportInstance;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
       
        if (!empty($request->month)) {
            $month = $request->month;
            $reports = $this->instance->where('reporting_time','LIKE',"%{$month}%")->orderBy('reporting_time', 'desc')->get();
            
            return view('user.daily_report.index',compact('reports'));
        }

        $reports = $this->instance->orderBy('reporting_time', 'desc')->get();
        return view('user.daily_report.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyReportRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->instance->create($input);
        return redirect()->route('daily_report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->instance->find($id);

        $dayOfTheWeek = ['Sun','Man','Tue','Wed','Thu','Fri','Sat'];
        $week = $report->reporting_time->format('w');
        $w = $dayOfTheWeek[$week];

        return view('user.daily_report.show', compact('report','w'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = $this->instance->find($id);
        return view('user.daily_report.edit',compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'reporting_time' => 'required|before_or_equal:now',
            'title' => 'required|max:30',
            'content' => 'required|max:1000',
        ]);

        $updateReport = $request->all();
        $this->instance->find($id)->fill($updateReport)->save();
        return redirect()->route('daily_report.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->instance->find($id)->delete();
        return redirect()->route('daily_report.index');
    }
}
