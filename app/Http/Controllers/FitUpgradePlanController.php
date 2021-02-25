<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreCartOffer;
use App\Models\FitJuniorPlanRule;
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
       // dd($id);
        $FitJuniorPlanRule=FitJuniorPlanRule::where('precartofferid',$id)->paginate(50);
        return view('FitUpgradePlan.addRule',compact('FitJuniorPlanRule','id'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
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
            return redirect()->back()->with('success', 'New Rule Created Successfully!');
        }
        catch (Exception $e) {
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
                $response = FitJuniorPlanRule::where('productid',$arrEvent['productid'])->update($data);
                return redirect()->back()->with('success', 'Rule Updated Successfully!');
            }
            catch (\Exception $e)
            {
                DB::rollback();
                dd($e->getMessage());
                return redirect()->back()->with('error', 'Something went Wrong');
            }
    }
}