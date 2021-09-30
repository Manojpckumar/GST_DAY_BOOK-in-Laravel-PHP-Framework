<?php

namespace App\Http\Controllers;

use App\Models\PurchaseBill;
use App\Models\PurchaseBillSlabs;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Gstr;
use App\Models\AllBills;
use App\Models\BillSlabs;
use Illuminate\Support\Facades\File;

class PurchaseBillController extends Controller
{
    
    function purchasebillview()
    {
        $data = ['LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(), 'gstslabs' => Gstr::all()];
        return view('admin.purchasebill', $data);
    }

    function addpurchasebill(Request $request)
    {

        $request->validate([
            'partyName' => 'required',
            'gstNumber' => [
                'required',
                 'regex:/^([0][1-9]|[1-2][0-9]|[3][0-5])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/',
                 'unique:stores,s_gst'
              ],
            'invNumber' => 'required',
            'billDate' => 'required',
            'invDes' => 'required',
            'billAmt' => 'required',
            'cgstSum' => 'required',
            'sgstSum' => 'required',
            'igstSum' => 'required',
            'gstSum' => 'required'
        ]);


    
        // get all the data from $request
        $saletype = $request['saletype'];
        $stateSale = $request['stateSale'];
        $party_name = $request['partyName'];
        $gst_num = $request['gstNumber'];
        $inv_num = $request['invNumber'];
        $billDate = $request['billDate'];
        $bill_des = $request['invDes'];
        $billAmt = $request['billAmt'];
        
        $cgstSum = $request['cgstSum'];
        $sgstSum = $request['sgstSum'];
        $igstSum = $request['igstSum'];
        $gstSum = $request['gstSum'];

        $statePurchase = $request['statePurchase'];

        $sale_bill = 0;
        $store_code = Store::where('id','=',session('LoggedUser'))->pluck('store_code');
           
        $gst_slabs = $request->gst_slabs;
        $tax_amt = $request->tax_amt;
        $pro_unit = $request->pro_unit;
        $cgst = $request->cgst;
        $sgst = $request->sgst;
        $igst = $request->igst;

        // dynamic path check

        $path = public_path('upload/'.$store_code[0]);

        if(!File::isDirectory($path)){

            File::makeDirectory($path, 0777, true, false);
    
        }
     
        // IMAGE FOR
        foreach($request->file('img') as $file)
        {
            $name = time().'.'.$file->getClientOriginalName();
            $file->move($path, $name);
            $imgData[] = $name; 
        }

      
        // IMAGE FOR CLOSE

        // insert all the data into sale bill table 
        $saleBill = new AllBills();

        $saleBill->store_code = $store_code[0];
        $saleBill->party_name = $party_name;
        $saleBill->gst_num = $gst_num;
        $saleBill->inv_num = $inv_num;
        $saleBill->bill_type = 'P';
        $saleBill->bill_date = $billDate;
        $saleBill->pbill_amnt = $billAmt;
        $saleBill->sbill_amnt = 0;
        $saleBill->ebill_amnt = 0;
        $saleBill->slab_ref = 0;
        $saleBill->bill_naration = $bill_des;
        $saleBill->sale_type = 0;
        $saleBill->stateof_sp = $statePurchase;
        $saleBill->bill_copy = implode(",", $imgData);

        $saleBill->cgst_sump = $cgstSum;
        $saleBill->sgst_sump = $sgstSum;
        $saleBill->igst_sump = $igstSum;
        $saleBill->gst_sump = $gstSum;

        $saleBill->cgst_sums = 0;
        $saleBill->sgst_sums = 0;
        $saleBill->igst_sums = 0;
        $saleBill->gst_sums = 0;
       
        $saleBill->exp_type = 0;

        // $saleBill->bill_copy = implode(",", $imgData);

        $saleBill->save();
        $lastID = $saleBill->id;

        //   check wether the last inserted id is greater than 0
        if ($lastID > 0) {
            $FILENAME = 'PB' . str_repeat('0', (10) - strlen(rtrim($lastID))) . $lastID;

            $sale = AllBills::find($lastID);
            $sale->slab_ref = $FILENAME;
            $sale->save();
        }

        //  inserting the gst slabs inside the sale bill
        for ($count = 0; $count < count($gst_slabs); $count++) {
            $data = array(
                'gst_slab' => $gst_slabs[$count],
                'slab_ref' => $FILENAME,
                'tax_amount'  => $tax_amt[$count],
                'pro_unit'  => $pro_unit[$count],
                'pro_cgst'  => $cgst[$count],
                'pro_sgst'  => $sgst[$count],
                'pro_igst'  => $igst[$count]
            );
            $insert_data[] = $data;
        }

        BillSlabs::insert($insert_data);
        return back()->with('success', 'Purchase Bill Added Successfully');


    }

    // function addpurchasebill(Request $request)
    // {
    //     return $request;
    // }

}
