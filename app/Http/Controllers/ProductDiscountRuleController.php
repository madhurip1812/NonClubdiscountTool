<?php

namespace App\Http\Controllers;

//use App\FCProductInfo;
use App\LogError;
use Illuminate\Http\Request;
use App\ProductInfoWithTypeMRPChange;
use App\ProductNonClubDiscountDifference;
use App\ProductNonClubDiscountDifferenceLog;

class ProductDiscountRuleController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function prodNonClubDiscDiff()
    {
        $loggedUser = session('user');
        $url = request()->url();
        try{
            $productNonClubDiscountDifference = ProductNonClubDiscountDifference::paginate(50);
            return view('productNonClubDiscountDifference',compact('productNonClubDiscountDifference'));
        } catch (Exception $e) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch(\Illuminate\Database\QueryException $exception) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }
    public function searchProductDiscRule()
    {
        $loggedUser = session('user');
    	$arrProductIds = request()->get('arrProductIds');
    	$html = '';
        $url = request()->url();
        $maxdisc = 75;
        //$myJSON = ['MethodName' => 'GetProductInfoWithTypeMRPChange','GetData' => '{&quot;ReqData1&quot;:\'{&quot;psubcategyid&quot;:['.$subCategoryId.'],&quot;@PageNo&quot;: &quot;1&quot;}\'}'];
        $arrNotFoundProdId = [];
    	foreach ($arrProductIds as $key => $value) {
    		if($value!=''){
                /*$myJSON = ['MethodName' => 'GetProductDetails',
                'GetData' => '{&quot;ReqData1&quot;:\'{&quot;pProductID&quot;: &quot;'.$value.'&quot;}\'}'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://192.168.100.101/firstcry/fcevents/getdata?ReqID=121212121212122454545",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 500,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($myJSON),
                    CURLOPT_HTTPHEADER => array(
                      "Content-Type: application/json"
                  ),
                ));
                $response = curl_exec($curl);
                $response_de = json_decode($response);*/
                try{
                    $objProductInfoWithTypeMRPChange = ProductInfoWithTypeMRPChange::select('productid','productname','clubdiscount')->where('productid',$value)->first();
                    //if(count($response_de->data_1_1_1)>1){
                    if(!is_null($objProductInfoWithTypeMRPChange)){
                        if($objProductInfoWithTypeMRPChange->clubdiscount <= 75)
                            $maxdisc = $objProductInfoWithTypeMRPChange->clubdiscount;

                        $arrProdDetail = [$objProductInfoWithTypeMRPChange->productid,$objProductInfoWithTypeMRPChange->productname];
        	    		$productNonClubDiscountDifference = ProductNonClubDiscountDifference::find($value);
        	    		if($productNonClubDiscountDifference!=null){
        		            $html .= '<tr id="'.$productNonClubDiscountDifference->productid.'">';
                            $html .= '<td>'.$arrProdDetail[0].'</td>';
        		            $html .= '<td>'.$arrProdDetail[1].'</td>';
        		            $html .= '<td><input type="text" max="'.$maxdisc.'" name="nonclubdiscountdifference" id="nonclubdiscountdifference_'.$productNonClubDiscountDifference->productid.'" value="'.$productNonClubDiscountDifference->nonclubdiscountdifference.'" class="numbercommatxt form-control cls_input_'.$productNonClubDiscountDifference->productid.'"  style="display: none;" maxlength="2"><span id="err-nonclubdiscountdifference_'.$productNonClubDiscountDifference->productid.'" class="text-danger" style="display:none;"></span><span class="cls_span_'.$productNonClubDiscountDifference->productid.'" id="span_nonclubdiscountdifference_'.$productNonClubDiscountDifference->productid.'">'.$productNonClubDiscountDifference->nonclubdiscountdifference.'</span></td>';
        		            $html .= '<td><span id="span_nonclubdiscountdifferencetype_'.$productNonClubDiscountDifference->productid.'">'.$productNonClubDiscountDifference->nonclubdiscountdifferencetype.'</span></td>';
                            $ddt = ($productNonClubDiscountDifference->lastmodifieddate) ? date('d/m/Y',strtotime($productNonClubDiscountDifference->lastmodifieddate)) : '';
        		            $html .= '<td><span id="span_lastmodifieddate_'.$productNonClubDiscountDifference->productid.'">'.$ddt.'</span></td>';
        		            $html .= '<td><span id="span_lastmodifiedby_'.$productNonClubDiscountDifference->productid.'">'.$productNonClubDiscountDifference->lastmodifiedby.'</span></td>';
        		            $html .= '<td><button title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeProdRule(`'.$productNonClubDiscountDifference->productid.'`,`edit`);" id="btn_prod_disc_edit_'.$productNonClubDiscountDifference->productid.'"><i class="fa fa-edit"></i></button>';
        		            $html .= '<button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeProdRule(`'.$productNonClubDiscountDifference->productid.'`,`save`);" id="btn_prod_disc_save_'.$productNonClubDiscountDifference->productid.'" style="display: none;"><i class="fa fa-save"></i></button>';
                            if($productNonClubDiscountDifference->nonclubdiscountdifference==0){
                                $html .= '<button style="display:none;" title="Delete rule" type="button" class="btn btn-danger btn-sm " onclick="deleteProdRule(`'.$productNonClubDiscountDifference->productid.'`);" id="btn_prod_disc_delete_'.$productNonClubDiscountDifference->productid.'"><i class="fa fa-trash-o"></i></button>';
                            }
                            else{
                                $html .= '<button title="Delete rule" type="button" class="btn btn-danger btn-sm " onclick="deleteProdRule(`'.$productNonClubDiscountDifference->productid.'`);" id="btn_prod_disc_delete_'.$productNonClubDiscountDifference->productid.'"><i class="fa fa-trash-o"></i></button>';
                            }
        		            $html .= '</td></tr>';
        	    		} else{
        	    			$html .= '<tr id="'.$value.'">';
        		            $html .= '<td>'.$arrProdDetail[0].'</td>';
        		            $html .= '<td>'.$arrProdDetail[1].'</td>';
        		            $html .= '<td><input type="text" max="'.$maxdisc.'" name="nonclubdiscountdifference" id="nonclubdiscountdifference_'.$value.'" class="numbercommatxt form-control cls_input_'.$value.'"  style="display: none;" maxlength="10"><span class="cls_span_'.$value.'" id="span_nonclubdiscountdifference_'.$value.'"></span></td>';
        		            $html .= '<td><span id="span_nonclubdiscountdifferencetype_'.$value.'"></span></td>';
        		            $html .= '<td><span id="span_lastmodifieddate_'.$value.'"></span></td>';
        		            $html .= '<td><span id="span_lastmodifiedby_'.$value.'"></span></td>';
        		            $html .= '<td><button title="Add New rule" type="button" class="btn btn-secondary btn-sm mb-1" onclick="changeProdRule(`'.$value.'`,`add`);" id="btn_prod_disc_edit_'.$value.'"><i class="fa fa-plus"></i></button>';
        		            $html .= '<button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeProdRule(`'.$value.'`,`save`);" id="btn_prod_disc_save_'.$value.'" style="display: none;"><i class="fa fa-save"></i></button>';
                            $html .= '<button style="display:none;" title="Delete rule" type="button" class="btn btn-danger btn-sm " onclick="deleteProdRule(`'.$value.'`);" id="btn_prod_disc_delete_'.$value.'"><i class="fa fa-trash-o"></i></button>';
        		            $html .= '</td></tr>';
        	    		}
                    }
                    else{
                        $arrNotFoundProdId[] = $value;
                    }
                    return response()->json(['success'=>true,'found'=>$html,'notfound'=>implode(',',$arrNotFoundProdId)]);
                } catch (Exception $e) {
                    LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
                    return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
                } catch(\Illuminate\Database\QueryException $exception) {
                    LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
                    return response()->json(['success'=>false,'msg'=>$exception->getMessage()]);
                }
    		}
    	}
    	//return $html;
    	/*$productNonClubDiscountDifference = ProductNonClubDiscountDifference::whereIn('productid',$arrProductIds)->get();
    	return $productNonClubDiscountDifference->toArray();*/
    }
    public function updateProductDiscountRule(Request $request)
    {
        $loggedUser = session('user');
    	$arrInput = $request->all(); 
        $url = request()->url();
        $maxdisc = 75;

        $objProductInfoWithTypeMRPChange = ProductInfoWithTypeMRPChange::where('productid',$arrInput['productid'])->first();

        if($objProductInfoWithTypeMRPChange->clubdiscount <= 75)
            $maxdisc = $objProductInfoWithTypeMRPChange->clubdiscount;

        if($arrInput['nonclubdiscountdifference'] > $maxdisc)
            return response()->json(['data'=>"Non club discount can not exceed ".$maxdisc,'success'=>false]);

        $updateData = [
            'nonclubdiscountdifference' => $arrInput['nonclubdiscountdifference'],
            'nonclubdiscountdifferencetype' => 'ManualDiscountDifference',
            'ismanual' => 1,
            'lastmodifieddate' => date('Y-m-d H:i:s'),
            'lastmodifiedby' => $loggedUser->username??'',
        ];
        try {
            $nonClubDiscDiffRule = ProductNonClubDiscountDifference::updateOrCreate([
            	'productid'=>$arrInput['productid']
            ],$updateData);
            //dd($nonClubDiscDiffRule->toArray());
           	$nonClubDiscDiffRuleLog = ProductNonClubDiscountDifferenceLog::insert($nonClubDiscDiffRule->toArray());
            //if($response){
                return response()->json(['data'=>$updateData,'success'=>true]);
            /*} else {
                return response()->json(['data'=>'Something Went Wrong','success'=>false]);
            }*/
        } catch (Exception $e) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return response()->json(['data'=>$e->getMessage(),'success'=>false]);
        } catch(\Illuminate\Database\QueryException $exception) {
            //echo $exception->getMessage();
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return response()->json(['data'=>$exception->getMessage(),'success'=>false]);
        }
    }
}
