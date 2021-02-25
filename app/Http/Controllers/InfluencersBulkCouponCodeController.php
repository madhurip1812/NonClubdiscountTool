<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreCartOffer;
use App\Models\FitJuniorPlanRule;
use Exception;
use DB;
class InfluencersBulkCouponCodeController extends Controller
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
        return view('InfluencersBulkCoupon.home');
        
    }
    
}