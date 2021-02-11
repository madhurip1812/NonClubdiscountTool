<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;

use App\Models\SubscriptionCouponcodeModel;
use App\Models\SubscriptionTypeDetailModel;

use DB;

class CashbackController extends Controller
{
     /*
     Description - add/edit cashback data
     @request Http\Illuminate\Request
     @response Http\Illuminate\Response
    */
    public function addcashback(Request $request,$id='') {
      $id = !empty($id) ? base64_decode($id) : '';

      if(!empty($request->post())) { 
      	$request->validate([
      	  'rulefor' => 'required',
          'rulename'=>'required',
          'cashcoupon'=>'required',
          'cashoncoupon'=>'required',
          'cashoutcoupon'=>'required',
          'cashvaliddays'=>'required',
          'cashperc'=>'required',
          'cashmaxamnt'=>'required',
          'cashminpurc'=>'required',
          'emailtemplateid'=>'required',
          'cashstartdate'=>'required',
          'cashenddate' =>'required',
          'isactive' => 'required'
      	]); 
      	$cashstartdate = $request->cashstartdate??NULL;
      	$cashstarttimehr = $request->cashstarttimehr??NULL;
      	$cashstarttimemins = $request->cashstarttimemins??NULL;

      	$cashenddate = $request->cashenddate??NULL;
      	$cashendtimehr = $request->cashendtimehr??NULL;
      	$cashendtimemins = $request->cashendtimemins??NULL;
       
        $getCouponData = SubscriptionCouponcodeModel::find($request->cashcouponid);
        if(!empty($getCouponData)) {
          $creatdate = $getCouponData->CreatedDate;
          $creatby = $getCouponData->CreatedBy;
        } else {
          $creatdate = date('Y-m-d H:i:s');
          $creatby = session('user.username')??'';
        }

      	if(trim($request->rulefor) == 'time') {
          //insert in product/time cashabck

      	  $response = SubscriptionCouponcodeModel::updateOrCreate(['CashBackCouponID'=>$request->cashcouponid],['CashBackCoupon'=>$request->cashcoupon,'cashbackrulefor'=>'time','cashbackrulename'=>$request->rulename??'','cashbackoncoupon'=>$request->cashoncoupon??'','cashbackoutcoupon'=>$request->cashoutcoupon??'','CouponValidityDays'=>$request->cashvaliddays??0,'CashBackPercentage'=>$request->cashperc??0.0,'CashBackMaxAmount'=>$request->cashmaxamnt??0.0,'CashBackOnMinmumPurchase'=>$request->cashminpurc??0.0,'EmailTemplateID'=>$request->emailtemplateid??0,'CashBackStartDate'=>date('Y-m-d H:i:s',strtotime($cashstartdate .' ' . $cashstarttimehr . ':' . $cashstarttimemins)),'CashBackEndDate'=>date('Y-m-d H:i:s',strtotime($cashenddate .' ' . $cashendtimehr . ':' . $cashendtimemins)),'isactive'=>$request->isactive??0,'createdby'=>$creatby,'createddate'=>$creatdate,'LastModifiedBy'=>session('user.username')??'','LastModifiedDate'=>date('Y-m-d H:i:s'),'productids'=>$request->productids??'']);	
      	} else if($request->rulefor == 'intellikit') {

      		//insert in intellikit cashabck
      		$response = SubscriptionCouponcodeModel::updateOrCreate(['CashBackCouponID'=>$request->cashcouponid],['CashBackCoupon'=>$request->cashcoupon,'cashbackrulefor'=>'intellikit','cashbackrulename'=>$request->rulename??'','cashbackoncoupon'=>$request->cashoncoupon??'','cashbackoutcoupon'=>$request->cashoutcoupon??'','CouponValidityDays'=>$request->cashvaliddays??0,'CashBackPercentage'=>$request->cashperc??0.0,'CashBackMaxAmount'=>$request->cashmaxamnt??0.0,'CashBackOnMinmumPurchase'=>$request->cashminpurc??0.0,'EmailTemplateID'=>$request->emailtemplateid??0,'CashBackStartDate'=>date('Y-m-d H:i:s',strtotime($cashstartdate .' ' . $cashstarttimehr . ':' . $cashstarttimemins)),'CashBackEndDate'=>date('Y-m-d H:i:s',strtotime($cashenddate .' ' . $cashendtimehr . ':' . $cashendtimemins)),'isactive'=>$request->isactive??0,'createdby'=>$creatby,'createddate'=>$creatdate,'LastModifiedBy'=>session('user.username')??'','LastModifiedDate'=>date('Y-m-d H:i:s')]);
            $subscriptionType = [];
            $subscriptionType = [$request->intellikit3monthssubscrtype??0,$request->intellikit6monthssubscrtype??0,$request->intellikit9monthssubscrtype??0,$request->intellikit12monthssubscrtype??0];
            $subscriptionTypeLen = count($subscriptionType);

            $subscriptionBoxNo = [];
            $subscriptionBoxNo = [$request->intellikit3monthssubscrboxno??0,$request->intellikit6monthssubscrboxno??0,$request->intellikit9monthssubscrboxno??0,$request->intellikit12monthssubscrboxno??0];
            for($i = 0; $i < $subscriptionTypeLen; $i++) {
              SubscriptionTypeDetailModel::updateOrCreate(['subscriptioncouponcodeid'=>$response->CashBackCouponID,'subscriptiontype'=>$subscriptionType[$i]],[
              'subscriptioncouponcodeid'=>$response->CashBackCouponID,
              'subscriptiontype'=>$subscriptionType[$i],
              'subscriptionboxno'=>$subscriptionBoxNo[$i],
              'isactive'=>(int)'1'
	        ]);
            }
	        
      	} else {

      	}
      	if(!empty($response) && !empty($response->CashBackCouponID)) {
	        	return redirect()->back()->withSuccess('Record Added Successfully!');
	        }
      } else { 
        
        if(!empty($id)) {
          $cashBackData = SubscriptionCouponcodeModel::find($id);
          $subscriptionData = SubscriptionCouponcodeModel::find($id)->subscriptionTypeDetail;
          //echo "<pre>";print_R($subscriptionData[0]->subscriptiontypedetailid);exit;
          return view('cashback.add',compact('cashBackData','subscriptionData'));
        } else {
          return view('cashback.add');
        }
      }
      
    }
    
    /*
     Description - List cashback data
     @request Http\Illuminate\Request
     @response Http\Illuminate\Response
    */
    public function listcashback(Request $request) { 
      //print_r(DB::connection('pgsql')->table('discountconfig')->select('*')->get());exit;
      if(!empty($request->post())) {
        $startdate = $request->startdate??'';
        $enddate = $request->enddate??'';
        $createdfromdate = $request->createdfromdate??'';
        $createdtodate = $request->createdtodate??'';
        $id = $request->id??'';
        $requestData = $request->all();
        $where = [];
        if(!empty($request->coupon)) $where[] = ['CashBackCoupon','ilike','%' . $request->coupon . '%'];
     
        $response = SubscriptionCouponcodeModel::where($where)
        ->when(!empty($startdate) && empty($enddate),function($q,$startdate) {
          return $q->whereDate('CashBackStartDate',$startdate);
        })->when(empty($startdate) && !empty($enddate),function($q) use($enddate){
          return $q->whereDate('CashBackEndDate',$enddate);
        })->when(!empty($startdate) && !empty($enddate), function($q) use($startdate,$enddate) {
           return $q->whereDate('CashBackStartDate','>=',$startdate)->whereDate('CashBackEndDate','<=',$enddate);
        })->when(!empty($createdfromdate) && empty($createdtodate),function($q) use($createdfromdate){
          return $q->whereDate('CreatedDate',$createdfromdate);
        })->when(empty($createdfromdate) && !empty($createdtodate),function($q) use($createdtodate){
          return $q->whereDate('CreatedDate',$createdtodate);
        })->when(!empty($createdfromdate) && !empty($createdtodate), function($q) use($createdfromdate,$createdtodate) {
           return $q->whereDate('CreatedDate','>=',$createdfromdate)->whereDate('CreatedDate','<=',$createdtodate);
        })->when(!empty($id),function($q) use($id) {
          return $q->whereIn('CashBackCouponID',explode(',',$id));
        })->orderBy('CashBackCouponID')->paginate(5);
        return view('cashback.list',compact('response','requestData'));
      } else {
         return view('cashback.list');
      }
    }
    
     /*
     Description - redirect the request as per pageid in get request
     @request Http\Illuminate\Request
     @response Http\Illuminate\Response
    */
    public function main(Request $request,$id='') { 
      $id = !empty($id) ? base64_decode($id) : '';
      // if(!empty($request->post())) {
      //   if($request->accesskey == $request->secretkey) {
          if(!empty($id) && $id == 1) {
         //$pageData = PagemasterModel::find($id);
          return view('cashback.add');
         } else {
          echo "Invalid Request";
         }
      //   } else {
      //     echo "Invalid Request";
      //   }
      
      // } else {
      //   echo "Invalid Request" ;
      // }
    }
}


