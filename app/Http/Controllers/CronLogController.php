<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CronLog;
use DB;

class CronLogController extends Controller
{
    //
    public function cronLog(){
    	try{
    		$data = CronLog::orderBy(DB::raw('createddate::date'), 'DESC')->paginate(10);
    		return view('cronLog',compact('data'));
    	}catch(Exception $e){
    		print_r($e);
    	}
    }

    public function getCronLogData(Request $request){
    	$arr = $request->all();

    	if(empty($arr)){
    		// Display All
    		$data = CronLog::orderBy(DB::raw('createddate::date'), 'DESC')->paginate(10);
            return view('cronLog',compact('data'));
    	}else{
    		// Display On Condition
    		$startDate = isset($arr['cron_log_start_date']) ? $arr['cron_log_start_date'] : null;
            $endDate = isset($arr['cron_log_end_date']) ? $arr['cron_log_end_date'] : null;

            if(!empty($startDate) && !empty($endDate)){
                $data = CronLog::where(DB::raw('createddate::date'),'>=',$startDate)->where(DB::raw('createddate::date'),'<=',$endDate)->orderBy(DB::raw('createddate::date'), 'DESC')->paginate(10);
            }else if(!empty($startDate)){
                $data = CronLog::where(DB::raw('createddate::date'),'>=',$startDate)->orderBy(DB::raw('createddate::date'), 'DESC')->paginate(10);
            }else if(!empty($endDate)){
                $data = CronLog::where(DB::raw('createddate::date'),'<=',$endDate)->orderBy(DB::raw('createddate::date'), 'DESC')->paginate(10);
            }else{
                $data = CronLog::orderBy(DB::raw('createddate::date'), 'DESC')->paginate(10);
            }
            return view('cronLog',compact('data'))->with(compact('startDate'))->with(compact('endDate'));
    	}
    }
}
