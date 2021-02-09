<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NonClubDiscountDifferenceConditionsLog;
use App\Category;
use App\SubCategory;
use DB;

class DiscountDifferenceLogController extends Controller
{
    //

    public function nonClubDiscDiffConditionsLog(){
    	try{
    		$data = NonClubDiscountDifferenceConditionsLog::with('Category','SubCategory')->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
    		return view('nonClubDiscDiffConditionsLog',compact('data'));
    	}catch(Exception $e){
    		print_r($e);
    	}
    }

    public function getDiffConditionLogData(Request $request){
    	$arr = $request->all();

    	if(empty($arr)){
    		// Display All
    		$data = NonClubDiscountDifferenceConditionsLog::with('Category','SubCategory')->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            return view('nonClubDiscDiffConditionsLog',compact('data'));
    	}else{
    		// Display On Condition
    		$startDate = isset($arr['log_start_date']) ? $arr['log_start_date'] : null;
            $endDate = isset($arr['log_end_date']) ? $arr['log_end_date'] : null;

            if(!empty($startDate) && !empty($endDate)){
                $data = NonClubDiscountDifferenceConditionsLog::with('Category','SubCategory')->where(DB::raw('lastmodifieddate::date'),'>=',$startDate)->where(DB::raw('lastmodifieddate::date'),'<=',$endDate)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else if(!empty($startDate)){
                $data = NonClubDiscountDifferenceConditionsLog::with('Category','SubCategory')->where(DB::raw('lastmodifieddate::date'),'>=',$startDate)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else if(!empty($endDate)){
                $data = NonClubDiscountDifferenceConditionsLog::with('Category','SubCategory')->where(DB::raw('lastmodifieddate::date'),'<=',$endDate)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else{
                $data = NonClubDiscountDifferenceConditionsLog::with('Category','SubCategory')->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }
            return view('nonClubDiscDiffConditionsLog',compact('data'))->with(compact('startDate'))->with(compact('endDate'));
    	}
    }
}
