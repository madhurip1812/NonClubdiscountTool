<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductNonClubDiscountDifferenceLog;
use DB;

class ProductDiscountDifferenceLogController extends Controller
{
    //

    public function prodNonClubDiscDiffLog(){
    	try{
    		$data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
    		return view('productNonClubDiscountDifferenceLog',compact('data'));
    	}catch(Exception $e){
    		print_r($e);
    	}
    }

    public function getProductDiffConditionLogData(Request $request){
    	$arr = $request->all();

    	if(empty($arr)){
    		// Display All
    		$data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            return view('productNonClubDiscountDifferenceLog',compact('data'));
    	}else{
    		// Display On Condition
    		$startDate = isset($arr['prod_log_start_date']) ? $arr['prod_log_start_date'] : null;
            $endDate = isset($arr['prod_log_end_date']) ? $arr['prod_log_end_date'] : null;
            $productId_str = isset($arr['prod_log_productId']) ? $arr['prod_log_productId'] : null;
            $where = [];
            $productId = array();
            //date("Y-m-d H:i:s",strtotime($arr['ip-end-date']))
            if(!empty($productId_str)){
                $productId = explode(',', $productId_str);
            }

            if(!empty($startDate) && !empty($endDate) && !empty($productId)){
                $data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->where(DB::raw('lastmodifieddate::date'),'>=',$startDate)->where(DB::raw('lastmodifieddate::date'),'<=',$endDate)->whereIn('productid',$productId)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else if(!empty($startDate) && !empty($endDate)){
                $data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->where(DB::raw('lastmodifieddate::date'),'>=',$startDate)->where(DB::raw('lastmodifieddate::date'),'<=',$endDate)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else if(!empty($productId)){
                $data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->whereIn('productid',$productId)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else if(!empty($startDate)){
                $data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->where(DB::raw('lastmodifieddate::date'),'>=',$startDate)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else if(!empty($endDate)){
                $data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->where(DB::raw('lastmodifieddate::date'),'<=',$endDate)->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }else{
                $data = ProductNonClubDiscountDifferenceLog::with('productinfowithtype')->orderBy(DB::raw('lastmodifieddate::date'), 'DESC')->paginate(10);
            }
            return view('productNonClubDiscountDifferenceLog',compact('data'))->with(compact('startDate'))->with(compact('endDate'))->with(compact('productId_str'));
    	}
    }
}
