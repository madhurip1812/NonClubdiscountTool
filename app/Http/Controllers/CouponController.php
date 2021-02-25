<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\BrandMaster;
use App\Models\ExcludedBrand;
use App\Models\ExcludedCategory;
use App\Models\ExcludedSubCategory;
use App\Models\ExcludedProducts;
use DB;

class CouponController extends Controller
{
    public function excludeitems(Request $request) 
    {
        $ExcludedBrand=ExcludedBrand::all()->toarray(); 
        $ExcludedCategory=ExcludedCategory::all()->toarray(); 
        $ExcludedSubCategory=ExcludedSubCategory::all()->toarray(); 
        $ExcludedProducts=ExcludedProducts::all()->toarray();   
       // dd($ExcludedBrand,$ExcludedCategory, $ExcludedSubCategory,$ExcludedProducts);    
        return view('coupon.excludeitems',compact('ExcludedBrand','ExcludedCategory','ExcludedSubCategory','ExcludedProducts'));
     //dd("huh");
     //return view('coupon.excludeitems');
      
    }
     public function CouponExcludeIds(Request $request)
    {
      //dd(Session::get('user'));
        if(Session::get('user'))
        $loggedin=Session::get('user.username');
         $iscopied=0;
         switch ($request->btn) {
            case 'btnExcludeBrands':
                ExcludedBrand::query()->truncate();
                 try
                 {
                    $ExcludedBrand=new ExcludedBrand();
                    $ExcludedBrand->Brandids=$request->excludeval;                   
                    $ExcludedBrand->save();
                     $newvar["Brandids"]=$request->excludeval;
                     $newvar["ModifiedBy"]=$loggedin;
                     $newvar["Modifieddate"]=now();
                     $response = DB::connection('mysql_commonmaster')->table('excludebrandidhistory')->insert($newvar);
                    $iscopied=1; 
                    $save="Brands excluded successfully";
                 }
                 catch (Exception $e) {
                    $save=$e->getMessage();
                    $couponerrorlog=new couponerrorlog();
                    $couponerrorlog->clientip='';
                    $couponerrorlog->source='exclude coupon brandid ';
                    $couponerrorlog->message=$save;
                    $couponerrorlog->stacktrace=$e;
                    $couponerrorlog->additionalinfo='';
                    $couponerrorlog->createddate=now();
                    $couponerrorlog->save();
                }                
                break;

            case 'btnExcludeCat':
                  ExcludedCategory::query()->truncate();
                 try
                 {
                    $ExcludedCategory=new ExcludedCategory();
                    $ExcludedCategory->CategoryIds=$request->excludeval; 
                    $ExcludedCategory->save();
                    $newvar["CategoryIds"]=$request->excludeval;
                     $newvar["ModifiedBy"]=$loggedin;
                     $newvar["Modifieddate"]=now();
                     $response = DB::connection('mysql_commonmaster')->table('excludecategoryidhistory')->insert($newvar);
                    $iscopied=1;  
                    $save="Categories excluded successfully";
                 }
                 catch (Exception $e) {
                    $save=$e->getMessage();
                    $couponerrorlog=new couponerrorlog();
                    $couponerrorlog->clientip='';
                    $couponerrorlog->source='exclude coupon categoryid ';
                    $couponerrorlog->message=$save;
                    $couponerrorlog->stacktrace=$e;
                    $couponerrorlog->additionalinfo='';
                    $couponerrorlog->createddate=now();
                    $couponerrorlog->save();
                }                
                break;

            case 'btnExcldeSubCat':
                  ExcludedSubCategory::query()->truncate();
                 try
                 {
                    $ExcludedSubCategory=new ExcludedSubCategory();
                    $ExcludedSubCategory->SubCategoryids=$request->excludeval;
                    $ExcludedSubCategory->save();
                     $newvar["SubCategoryids"]=$request->excludeval;
                     $newvar["ModifiedBy"]=$loggedin;
                     $newvar["Modifieddate"]=now();
                     $response = DB::connection('mysql_commonmaster')->table('excludesubcategoryidhistory')->insert($newvar);
                    $iscopied=1; 
                    $save="Subcategories excluded successfully";
                 }
                 catch (Exception $e) {
                    $save=$e->getMessage();
                    $couponerrorlog=new couponerrorlog();
                    $couponerrorlog->clientip='';
                    $couponerrorlog->source='exclude coupon subcategoryid ';
                    $couponerrorlog->message=$save;
                    $couponerrorlog->stacktrace=$e;
                    $couponerrorlog->additionalinfo='';
                    $couponerrorlog->createddate=now();
                    $couponerrorlog->save();
                    
                }                
                break;

            case 'btnExcludeProducts': 
                ExcludedProducts::query()->truncate();
                 try
                 {
                    $ExcludedProducts=new ExcludedProducts();
                    $ExcludedProducts->productids=$request->excludeval;
                    $ExcludedProducts->save();
                     $newvar["productids"]=$request->excludeval;
                     $newvar["modifiedby"]=$loggedin;
                     $newvar["modifieddate"]=now();
                     $response = DB::connection('mysql_commonmaster')->table('excludeproductidhistory')->insert($newvar);
                    $iscopied=1; 
                    $save="products excluded successfully";
                 }
                 catch (Exception $e) {
                    $save=$e->getMessage();
                    $couponerrorlog=new couponerrorlog();
                    $couponerrorlog->clientip='';
                    $couponerrorlog->source='exclude coupon productid ';
                    $couponerrorlog->message=$save;
                    $couponerrorlog->stacktrace=$e;
                    $couponerrorlog->additionalinfo='';
                    $couponerrorlog->createddate=now();
                    $couponerrorlog->save();
                    
                }                
                break;
             case "btnShowDesc":
                 try{

                    $ExcludedBrand=ExcludedBrand::pluck('Brandids')->toarray(); 
                    $brands=explode(",",$ExcludedBrand[0]);
                    $commonbrands=BrandMaster::whereIn('BrandID', $brands)->pluck('BrandID','BrandName')->sortBy('BrandID')->toarray();
                    //category
                    $ExcludedCategory=ExcludedCategory::pluck('CategoryIds')->toarray(); 
                    $Category=explode(",",$ExcludedCategory[0]);
                    $commonCategory=Category::whereIn('ProductCatID', $Category)->pluck('ProductCatID','CategoryName')->sortBy('ProductCatID')->toarray();
                    //subcategory
                    $ExcludedSubCategory=ExcludedSubCategory::pluck('SubCategoryids')->toarray(); 
                    $subCategory=explode(",",$ExcludedSubCategory[0]);
                    $commonsubCategory=SubCategory::whereIn('SubCatID', $subCategory)->pluck('SubCatID','SubCategoryName')->sortBy('SubCatID')->toarray();
                    $save['commonbrands']=$commonbrands;
                    $save['commonCategory']=$commonCategory;
                    $save['commonsubCategory']=$commonsubCategory;
                     $iscopied=1; 
                 }
                 catch (Exception $e) {
                    $save=$e->getMessage();
                    $couponerrorlog=new couponerrorlog();
                    $couponerrorlog->clientip='';
                    $couponerrorlog->source='exclude coupon show description';
                    $couponerrorlog->message=$save;
                    $couponerrorlog->stacktrace=$e;
                    $couponerrorlog->additionalinfo='';
                    $couponerrorlog->createddate=now();
                    $couponerrorlog->save();
                    
                  }           

                break;

          }
        return response()->json(['success' =>$iscopied, 'message' => $save], 200);
    }
    public function ExcludeItemsLog()
    {
         
     $ExcludedBrandlog=  DB::connection('mysql_commonmaster')->table('excludebrandidhistory')->orderBy('Modifieddate', 'desc')->take(10)->get();
    $ExcludedCatlog=  DB::connection('mysql_commonmaster')->table('excludecategoryidhistory')->orderBy('Modifieddate', 'desc')->take(10)->get();
    $ExcludedSubCatlog=  DB::connection('mysql_commonmaster')->table('excludesubcategoryidhistory')->orderBy('Modifieddate', 'desc')->take(10)->get();
    $ExcludedProductlog=  DB::connection('mysql_commonmaster')->table('excludeproductidhistory')->orderBy('Modifieddate', 'desc')->take(10)->get();
        return view('coupon.excludeItemsLog',compact('ExcludedBrandlog','ExcludedCatlog','ExcludedSubCatlog','ExcludedProductlog'));
    }
}
