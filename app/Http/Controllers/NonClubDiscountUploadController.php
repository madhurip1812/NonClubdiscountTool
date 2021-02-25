<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductInfoWithTypeMRPChange;
use App\ProductNonClubDiscountDifference;
use App\ProductNonClubDiscountDifferenceLog;

class NonClubDiscountUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('UploadNonClubDiscount');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $skippedPid = array();
        $productid = "";
        $nonclubdiscountdifference = "";
        $lastmodifieddate = date('Y-m-d H:i:s');
        $lastmodifiedby = session('user.username')??'';
        $nonclubdiscountdifferencetype = 'ManualDiscountDifference';
        $ismanual = 1;

        $request->validate([
            "csv_file" => "required",
        ]);

        $file = $request->file("csv_file");
        $csvData = file_get_contents($file);

        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);
        $arrClubDisc = array_column($rows,1);
        foreach ($rows as $row) {
            if (isset($row[0])) {
                if ($row[0] != "") {
                    $row = array_combine($header, $row);

                    $productid = $row["productid"];
                    $nonclubdiscount = $row["nonclubdiscount"];

                    $nonClubDiscData = array(
                        "productid" => $productid,
                        "nonclubdiscount" => $nonclubdiscount,
                        "lastmodifieddate" => $lastmodifieddate,
                        "lastmodifiedby" => $lastmodifiedby,
                        "nonclubdiscountdifferencetype" => $nonclubdiscountdifferencetype,
                        "ismanual" => $ismanual,
                        "nonclubdiscountdifference" => 0,
                    );
                    //-------- check if lead already exists ---------
                    $checkClubDiscount = ProductInfoWithTypeMRPChange::where("productid", "=", $row["productid"])->first();

                    if (!is_null($checkClubDiscount)) {
                        $clubDiscountDiff = $checkClubDiscount->clubdiscount - $nonclubdiscount;
                        $nonClubDiscData['nonclubdiscountdifference'] = $clubDiscountDiff;
                        if($clubDiscountDiff < 0){
                            $skippedPid[] = "Non club discount for ".$row['productid']." product can not exceed ".$checkClubDiscount->clubdiscount;
                            continue;
                        }
                    }

                    $checkDiscount = ProductNonClubDiscountDifference::where("productid", "=", $row["productid"])->first();
                    if (!is_null($checkDiscount)) {
                        $updateDiscount = ProductNonClubDiscountDifference::where("productid", "=", $row["productid"])->update($nonClubDiscData);
                        if($updateDiscount == true) {
                            $nonClubDiscDiffRuleLog = ProductNonClubDiscountDifferenceLog::insert($nonClubDiscData);
                            $data[] = $row["productid"];
                        }
                    } else {
                        $nonClubDiscount = ProductNonClubDiscountDifference::create($nonClubDiscData);
                        if(!is_null($nonClubDiscount)) {
                            $nonClubDiscDiffRuleLog = ProductNonClubDiscountDifferenceLog::insert($nonClubDiscData);
                            $data[] = $nonClubDiscount->productid;
                        }                        
                    }
                }
            }
        }
        if(count($skippedPid)>0)
            return back()->withErrors($skippedPid);
        else
            return back()->with('success','Non Club Discount for given products are updated');
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

}
