<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreCartOffer;
use App\Models\FitJuniorPlanRule;
use App\Models\FitJuniorPlanRuleLog;
use App\Models\B2BCashbackOrderMaster;
use Exception;
use DB;
class FitUpgradePlanController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    /*public function __construct()
    {
    $this->middleware('auth');
    }*/

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $PreCartOffer=PreCartOffer::paginate(50);
    // dd($PreCartOffer);
        return view('FitUpgradePlan.home',compact('PreCartOffer'));

    }
    public function search($id)
    {
        $FitJuniorPlanRule=FitJuniorPlanRule::where('precartofferid',$id)->paginate(50);
        return view('FitUpgradePlan.addRule',compact('FitJuniorPlanRule','id'));
    }
    public function getb2bCashbackOrders($id)
    {
        $id = !empty($id) ? base64_decode($id) : '';
        $objB2BCashbackOrderMaster=B2BCashbackOrderMaster::where('CashBackRuleName',$id)->get();
        // dd($objB2BCashbackOrderMaster);
        return view('FitUpgradePlan.b2bcashback',compact('objB2BCashbackOrderMaster','id'));
    }
    public function store(Request $request)
    {
        $arrInput = $request->all();
        try {     
            $fitplanobject=new FitJuniorPlanRule();
            $fitplanobject->productid =$request->productid;
            $fitplanobject->precartofferid =$request->precartofferid;
            $fitplanobject->productname =  $request->productname;
            $fitplanobject->upgradeplanoption =$request->upgradeplanid ;
            $fitplanobject->upgradedatefrom= $request->upgradedayfrom;
            $fitplanobject->upgradedateto =$request->upgradedayto;
            $fitplanobject->upgradepostexpiry = $request->upgradepostexpiry ;
            $fitplanobject->isactive = $request->isactive ;
            $fitplanobject->save();
            $LogData = [
                'productid' => $arrInput['productid'],
                'precartofferid' => $arrInput['precartofferid'],
                'productname' => $arrInput['productname'],
                'upgradeplanoption' => $arrInput['upgradeplanid'],
                'upgradedatefrom' => $arrInput['upgradedayfrom'],
                'upgradedateto' => $arrInput['upgradedayto'],
                'upgradepostexpiry' => $arrInput['upgradepostexpiry'],
                'isactive' => $arrInput['isactive']
            ];       
            FitJuniorPlanRuleLog::create($LogData);
            $objFitJuniorPlanRule = FitJuniorPlanRule::where('precartofferid',$arrInput['precartofferid'])->get();
            if(!is_null($objFitJuniorPlanRule)){

                /*$allupgradeplanoption = $objFitJuniorPlanRule->pluck('upgradeplanoption')->toArray();
                $strupgradeplanoption = implode(',', $allupgradeplanoption);
                $arrupgradeplanoption = explode(',', $strupgradeplanoption);
                $arrApplicableProductIds = array_unique($arrupgradeplanoption);*/

                $arrFitJuniorPlanRule = $objFitJuniorPlanRule->toArray();
                $jsonRuleData = json_encode($arrFitJuniorPlanRule);

                $objPreCartOffer = PreCartOffer::find($arrInput['precartofferid']);
                // $objPreCartOffer->applicableproductids = implode(',', $arrApplicableProductIds);
                $objPreCartOffer->ruledata = $jsonRuleData;
                $objPreCartOffer->save();
            }
            return redirect()->back()->with('success', 'New Rule Created Successfully!');
        }
        catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
    public function edit(Request $request)
    {
        //dd($request);
        $request = request()->all(); 
        //dd($request);       
        $productid=$request['productid'];
        $FitJuniorPlanRule=FitJuniorPlanRule::where('productid',$productid)->first()->toArray();
        // dd($FitJuniorPlanRule);
        $returnHTML = view('FitUpgradePlan.editRule',compact('FitJuniorPlanRule'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
    public function update($id)
    {
        $arrEvent = request()->all();
        //dd($arrEvent);
        try {
            $data = [             
                'productname'    => ($arrEvent['productname']),
                'upgradeplanoption'    => ($arrEvent['upgradeplanid']),
                'upgradedatefrom'     => ($arrEvent['upgradedayfrom']),
                'upgradedateto'      => ($arrEvent['upgradedayto']),
                'upgradepostexpiry'     => ($arrEvent['upgradepostexpiry']),
                'isactive'    => ($arrEvent['isactive']),

            ];
            $objFitJuniorPlanRule = FitJuniorPlanRule::where('productid',$arrEvent['productid'])->first();
            $arrEvent['precartofferid'] = $objFitJuniorPlanRule->precartofferid;
            $response = $objFitJuniorPlanRule->update($data);
            $LogData = [
                'productid' => $arrEvent['productid'],
                'precartofferid' => $arrEvent['precartofferid'],
                'productname' => $arrEvent['productname'],
                'upgradeplanoption' => $arrEvent['upgradeplanid'],
                'upgradedatefrom' => $arrEvent['upgradedayfrom'],
                'upgradedateto' => $arrEvent['upgradedayto'],
                'upgradepostexpiry' => $arrEvent['upgradepostexpiry'],
                'isactive' => $arrEvent['isactive']
            ];       
            FitJuniorPlanRuleLog::create($LogData);
            $objFitJuniorPlanRule = FitJuniorPlanRule::where('precartofferid',$arrEvent['precartofferid'])->get();
            if(!is_null($objFitJuniorPlanRule)){
               /* $allupgradeplanoption = $objFitJuniorPlanRule->pluck('upgradeplanoption')->toArray();
                $strupgradeplanoption = implode(',', $allupgradeplanoption);
                $arrupgradeplanoption = explode(',', $strupgradeplanoption);
                $arrApplicableProductIds = array_unique($arrupgradeplanoption);*/

                $arrFitJuniorPlanRule = $objFitJuniorPlanRule->toArray();
                $jsonRuleData = json_encode($arrFitJuniorPlanRule);
                $objPreCartOffer = PreCartOffer::find($arrEvent['precartofferid']);
                // $objPreCartOffer->applicableproductids = implode(',', $arrApplicableProductIds);
                $objPreCartOffer->ruledata = $jsonRuleData;
                $objPreCartOffer->save();
            }
            return redirect()->back()->with('success', 'Rule Updated Successfully!');
        }
        catch (\Exception $e)
        {
            DB::rollback();
            //dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went Wrong');
        }
    }
}