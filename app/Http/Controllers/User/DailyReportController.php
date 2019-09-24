<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Auth;

class DailyReportController extends Controller
{
    

    public function __construct(DailyReport $instanceClass)
    {
        $this->middleware('auth');
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
            $reports = DailyReport::where('reporting_time','LIKE',"%{$month}%")->orderBy('reporting_time', 'desc')->get();
            
            return view('user.daily_report.index',compact('reports'));
        }
        
        $reports = DailyReport::orderBy('reporting_time', 'desc')->get();
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
    public function store(Request $request)
    {
        $request->validate([
            'reporting_time' => 'required|before_or_equal:now',
            'title' => 'required|max:30',
            'content' => 'required|max:1000',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::id();
        DailyReport::create($input);
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
        $report = DailyReport::find($id);

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
        $report = DailyReport::find($id);
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
        DailyReport::find($id)->fill($updateReport)->save();
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
        DailyReport::find($id)->delete();
        return redirect()->route('daily_report.index');
    }
}
