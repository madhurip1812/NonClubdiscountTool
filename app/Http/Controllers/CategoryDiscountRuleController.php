<?php

namespace App\Http\Controllers;

use Validator;
use App\Category;
use App\LogError;
use App\SubCategory;
use App\ProductInfoWithType;
use App\NonClubDiscountDifferenceConditions;
use App\NonClubDiscountDifferenceConditionsLog;
use Illuminate\Http\Request;

class CategoryDiscountRuleController extends Controller
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
        return view('home');
    }
    public function nonClubDiscDiffConditions()
    {
        $loggedUser = session('user');
        $url = request()->url();
        /* for new structure*/
        try {
            $objCategories = Category::with('subcategory.subcatdiscountRule','catdiscountRule')->whereHas('subcategory', function($q) {
                $q->whereHas('subcatdiscountRule');
            })->get();
            $categories = $objCategories->toArray();
            return view('nonClubDiscDiffConditions1',compact('categories'));

            /* for old structure*/
           /* $objCategories = Category::whereHas('subcategory', function($q) {
                $q->whereHas('subcatdiscountRule');
            })->with(['subcategory'=> function($qry){
                 $qry->with(['subcatdiscountRule' => function ($qry) {
                    $qry->orderBy('typeid', 'ASC');
                }]);
            }])->get();*/
        } catch (Exception $e) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch(\Illuminate\Database\QueryException $exception) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategoryDiscountRule(Request $request,$id)
    {
        $loggedUser = session('user');
        $arrInput = $request->all(); 
        $url = request()->url();
        $subcategoryid = $arrInput['subcategoryid'];
        if(!isset($arrInput['action'])){
            try {
                $objnonClubDiscDiffRule = NonClubDiscountDifferenceConditions::where('subcategoryid',$subcategoryid)->where('typeid','-1')->first();
                if($objnonClubDiscDiffRule==null){
                    return response()->json(['errors'=>['Rule not exist on this subcategory']]);
                }
            } catch (Exception $e) {
                LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
                return response()->json(['errors'=>[$exception->getMessage()]]);
            } catch(\Illuminate\Database\QueryException $exception) {
                LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
                return response()->json(['errors'=>[$exception->getMessage()]]);
            }
        }
        if(isset($arrInput['action']) && $arrInput['action']=='delete_rule'){
            $updateData = [
                'avgvalueforlow' => null,
                'discountdifferentforlow' => null,
                'discountdifferenceformid' => null,
                'avgvalueforhigh' => null,
                'discountdifferenceforhigh' => null,
                'lastmodifieddate' => date('Y-m-d H:i:s'),
                'lastmodifiedby' => $loggedUser->username??'',
            ];
        } else if(isset($arrInput['typename']) && $arrInput['typename']==null) {
            $validator = Validator::make($request->all(), [
                'avgvalueforlow' => 'required|numeric|max:100',
                'discountdifferentforlow' => 'required|numeric|max:100',
                'discountdifferenceformid' => 'required|numeric|max:100',
                'avgvalueforhigh' => 'required|numeric|max:100',
                'discountdifferenceforhigh' => 'required|numeric|max:100',
            ]);

            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }

        }
        $updateData = [
            'avgvalueforlow' => $arrInput['avgvalueforlow'],
            'discountdifferentforlow' => $arrInput['discountdifferentforlow'],
            'discountdifferenceformid' => $arrInput['discountdifferenceformid'],
            'avgvalueforhigh' => $arrInput['avgvalueforhigh'],
            'discountdifferenceforhigh' => $arrInput['discountdifferenceforhigh'],
            'lastmodifieddate' => date('Y-m-d H:i:s'),
            'lastmodifiedby' => $loggedUser->username??'',
        ];
        try {
            $nonClubDiscDiffRule = NonClubDiscountDifferenceConditions::find($id);
            $response = $nonClubDiscDiffRule->update($updateData);
            //dd($nonClubDiscDiffRule->toArray());
            $nonClubDiscDiffRule = NonClubDiscountDifferenceConditionsLog::create($nonClubDiscDiffRule->toArray());
            if($response){
                return response()->json(['data'=>$updateData,'success'=>true]);
            } else {
                return response()->json(['data'=>'Something Went Wrong','success'=>false]);
            }
        } catch (Exception $e) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return response()->json(['data'=>$e->getMessage(),'success'=>false]);
        } catch(\Illuminate\Database\QueryException $exception) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return response()->json(['data'=>$e->getMessage(),'success'=>false]);
        }
    }
    public function addCategoryDiscountRule(Request $request)
    {
        $loggedUser = session('user');
        $arrInput = $request->all(); 
        $url = request()->url();
        if(isset($arrInput['typename']) && $arrInput['typename']==null){
            $validator = Validator::make($request->all(), [
                'avgvalueforlow' => 'required|numeric|max:100',
                'discountdifferentforlow' => 'required|numeric|max:100',
                'discountdifferenceformid' => 'required|numeric|max:100',
                'avgvalueforhigh' => 'required|numeric|max:100',
                'discountdifferenceforhigh' => 'required|numeric|max:100',
            ]);
            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
        }
        if($arrInput['typename']!=null)
            $arrTypeDetail = explode('+++', $arrInput['typename']);
        else
            $arrTypeDetail = ['-1','Rest All'];
        
        $createData = [
            'categoryid' => $arrInput['categoryid'],
            'subcategoryid' => $arrInput['subcategoryid'],
            'typeid' => $arrTypeDetail[0],
            'typename' => $arrTypeDetail[1],
            'avgvalueforlow' => $arrInput['avgvalueforlow'],
            'discountdifferentforlow' => $arrInput['discountdifferentforlow'],
            'discountdifferenceformid' => $arrInput['discountdifferenceformid'],
            'avgvalueforhigh' => $arrInput['avgvalueforhigh'],
            'discountdifferenceforhigh' => $arrInput['discountdifferenceforhigh'],
            'createddate' => date('Y-m-d H:i:s'),
            'createdby' => $loggedUser->username??'',
            'lastmodifieddate' => date('Y-m-d H:i:s'),
            'lastmodifiedby' => $loggedUser->username??'',
            'isactive' => '1',
        ];
        //dd($createData);
        try {
            $nonClubDiscDiffRule = NonClubDiscountDifferenceConditions::create($createData);
            NonClubDiscountDifferenceConditionsLog::create($nonClubDiscDiffRule->toArray());
            return response()->json(['data'=>$nonClubDiscDiffRule->toArray(),'success'=>true]);
        } catch (Exception $e) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return response()->json(['errors'=>[$e->getMessage()],'success'=>false]);
        } catch(\Illuminate\Database\QueryException $exception) {
            //echo $exception->getMessage();
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return response()->json(['errors'=>[$exception->getMessage()],'success'=>false]);
        }
    }
    public function editAllDiscountRules()
    {
        $loggedUser = session('user');
        $url = request()->url();
        try {
            $categories = Category::get();
            //$productsTypes = $this->getProductTypes();
            return view('editAllDiscountRules',compact('categories'));
        } catch (Exception $e) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch(\Illuminate\Database\QueryException $exception) {
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }
    public function getProductTypes()
    {
        $loggedUser = session('user');
        $subCategoryId = request()->get('subCategoryId');
        $url = request()->url();
        /*$myJSON = ['MethodName' => 'GetProductInfoWithType','GetData' => '{&quot;ReqData1&quot;:\'{&quot;psubcategyid&quot;:['.$subCategoryId.'],&quot;@PageNo&quot;: &quot;1&quot;}\'}'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://110.10.7.80/firstcry/fcevents/getdata?ReqID=121212121212122454545",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 500,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($myJSON),
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json"
          ),
        ));
        $response = curl_exec($curl);
        $response_de = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        if($err){
            dd("cURL Error #:" . $err);
            return false;
        } 
        else {
            $arr = [];
            $newArr = [];
            foreach ($response_de->data_1_1_1 as $key => $value) {
                if($key==0){
                    $arr = $value;
                }else{
                    foreach ($value as $key1 => $value1) {
                        if(in_array($arr[$key1], ['subcategyid','TypeID','TypeTitle']))
                            $newArr[$key][$arr[$key1]] = $value1;
                    }
                }
            }
            return array_unique($newArr, SORT_REGULAR);
        }*/
        try{
            $objProductInfoWithType = ProductInfoWithType::select('typeid','typetitle')->where('subcategyid',$subCategoryId)->get();
            return ['success'=>true, 'data'=>array_unique($objProductInfoWithType->toArray(),SORT_REGULAR)];
        } catch (Exception $e) {
            $subCatLevelExist = false;
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return ['success'=>false,'data'=> $e->getMessage()];
        } catch(\Illuminate\Database\QueryException $exception) {
            $subCatLevelExist = false;
        //echo $exception->getMessage();
            LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
            return ['success'=>false,'data'=> $exception->getMessage()];
        }
        //$subCategories = SubCategory::where('productcatid',$catId)->get();
        //return $subCategories;
    }
    public function getSubCategories()
    {
        $loggedUser = session('user');
        $catId = request()->get('categoryid');
        $subCategories = SubCategory::where('productcatid',$catId)->get();
        return $subCategories;
    }
    public function getExistingRule(){
        $loggedUser = session('user');
        $url = request()->url();
        $subCatId = request()->get('subCatId');
        $typeName = request()->get('typeName');
        $arrTypeDetail = explode('+++', $typeName);
        $subCatLevelExist = true;

        //dd($subCatId);
        if($subCatId!=null){
            try {
                $objnonClubDiscDiffRule = NonClubDiscountDifferenceConditions::where('subcategoryid',$subCatId)->where('typeid','-1')->first();
                if($objnonClubDiscDiffRule==null){
                    $subCatLevelExist = false;
                    //return ['success'=>true,'data'=>[]];
                }
                $nonClubDiscDiffRule = NonClubDiscountDifferenceConditions::where('subcategoryid',$subCatId);
                if($typeName!=null){
                    $nonClubDiscDiffRule = $nonClubDiscDiffRule->where('typeid',$arrTypeDetail[0]);
                }else{
                    $nonClubDiscDiffRule = $nonClubDiscDiffRule->where('typeid','-1');
                }
                return ['success'=>true,'data'=> $nonClubDiscDiffRule->first(),'subCatLevelExist' => $subCatLevelExist];
            } catch (Exception $e) {
                $subCatLevelExist = false;
                LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$e->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
                return ['success'=>false,'data'=> $e->getMessage(),'subCatLevelExist' => $subCatLevelExist];
            } catch(\Illuminate\Database\QueryException $exception) {
                $subCatLevelExist = false;
            //echo $exception->getMessage();
                LogError::create(['username'=>$loggedUser->username??'','url'=>$url,'message'=>$exception->getMessage(),'clientip'=>$_SERVER['REMOTE_ADDR'],'createddate'=>date('Y-m-d H:i:s')]);
                return ['success'=>false,'data'=> $exception->getMessage(),'subCatLevelExist' => $subCatLevelExist];
            }
        } else {
            return ['success'=>false,'data'=> 'Rule not exist on this subcategory','subCatLevelExist' => $subCatLevelExist];
        }
    }
    public function getSubCatWiseDetail()
    {
        $loggedUser = session('user');
        $subCategoryId = request()->get('subCategoryId');
        $objSubvalue = SubCategory::where('subcatid',$subCategoryId)->with(['subcatdiscountRule' => function ($qry) {
                $qry->orderBy('typeid', 'ASC');
            }])->first();

        $subvalue = $objSubvalue->toArray();
        $html = view('subCatTypeTable', compact('subvalue'))->render();

        return response()->json(['html' => $html]);
    }
}
