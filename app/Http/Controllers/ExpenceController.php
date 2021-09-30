<?php

namespace App\Http\Controllers;

use App\Models\AllBills;
use App\Models\Expences;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\BillSlabs;

class ExpenceController extends Controller
{
    function recordexpence()
    {
        $data = ['LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.expences', $data);
    }


    function addexpences(Request $request)
    {
        $exp_type = $request->expences;
        $exp_desc = $request->exp_des;
        $exp_amt = $request->exp_amt;
        $exp_dates = $request->exp_dates;

        $store_code = Store::where('id','=',session('LoggedUser'))->pluck('store_code');

        for ($count = 0; $count < count($exp_type); $count++) {
            $data = array(
                'store_code' => $store_code[0],
                'party_name' => 0,
                'gst_num' => 0,
                'inv_num' => 0,
                'bill_type' => 'E',
                'bill_date' => $exp_dates[$count],
                'sbill_amnt' => 0,
                'pbill_amnt' => 0,
                
                'ebill_amnt' => $exp_amt[$count],
                'slab_ref' => 0,
                'bill_naration' => $exp_desc[$count],
                'sale_type' => 0,
                'stateof_sp' => 0,
                'bill_copy' => 0,
                'cgst_sums' => 0,
                'sgst_sums' => 0,
                'igst_sums' => 0,
                'gst_sums' => 0,

                'cgst_sump' => 0,
                'sgst_sump' => 0,
                'igst_sump' => 0,
                'gst_sump' => 0,
                'exp_type' => $exp_type[$count]
                
               
            );
            $insert_data[] = $data;
        }

        AllBills::insert($insert_data);
        return back()->with('success', 'Expences Added Successfully');
    }
}
