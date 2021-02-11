<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Session;
use App\Models\UserLoginModel;
use App\Models\SessionCountryModel;
use App\Models\PagemasterModel;

class UserLoginController extends Controller
{
    public function index($parameters='') {
    	
        $decodedParams = base64_decode($parameters);//echo base64_decode(base64_encode('rekha@gmail.com::rekha@123::2021-01-28::eng::1::1::1::uae'));exit;
        $decodedParams = explode('::',$decodedParams);
        $emailaddress = $decodedParams[0];
        $password = $decodedParams[1];
        $date = $decodedParams[2];
        $langauge = $decodedParams[3];
        $pageid = $decodedParams[4];
        $accesskey = $decodedParams[5];
        $secretkey = $decodedParams[6];
        $countrycode = $decodedParams[7];
        
        $whereArr = array();
        $whereArr['username'] = $emailaddress;
        $whereArr['password'] = $password;
        $whereArr['logindate'] = $date;
        $whereArr['isactive'] = 1;
        $responseData = UserLoginModel::where($whereArr)->get();
        
       
        // 	//create log for this session
        //     SessionCountryModel::create([
        //       'countrycode'=>$countrycode,
        //       'sessionstarted'=>date('Y-m-d H:i:s'),
        //       'createddate'=>date('Y-m-d H:i:s')
        //     ]);
       
        if(!empty($responseData) && count($responseData) > 0) {
        if(!empty($accesskey) && !empty($secretkey) && $accesskey == $secretkey) {
          if(!empty($pageid)) {
            $pageData = PagemasterModel::find($pageid);
            if(!empty($pageData)) {
               $user = json_decode(json_encode($responseData[0]));
               Session::put('user',$user); 
              return redirect($pageData->pagename);
            } else {
               echo "Invalid Request";    
            }
          } else {
            echo "Invalid Request";
          }
        } else {
            echo "Invalid Request";
        }
      } else {
        echo "Invalid Request";
      }
    }

    public function logout() {
    	Session::forget('user');
    }
}
