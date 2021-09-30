<?php

namespace App\Http\Controllers;

use App\Models\AllBills;
use App\Models\Gstr;
use App\Models\SaleBill;
use App\Models\SaleBillSlab;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\BillSlabs;
use Illuminate\Support\Facades\File;

class SaleBillController extends Controller
{
    function salebillview()
    {

        $data = ['LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(), 'gstslabs' => Gstr::all()];
        return view('admin.salebill', $data);
    }

    function addsalebill(Request $request)
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
        $sale_bill = 0;
        $store_code = Store::where('id','=',session('LoggedUser'))->pluck('store_code');
           

        $gst_slabs = $request->gst_slabs;
        $tax_amt = $request->tax_amt;
        $pro_unit = $request->pro_unit;
        $cgst = $request->cgst;
        $sgst = $request->sgst;
        $igst = $request->igst;

        
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
        $saleBill->bill_type = 'S';
        $saleBill->bill_date = $billDate;
        $saleBill->sbill_amnt = $billAmt;
        $saleBill->pbill_amnt = 0;
        $saleBill->ebill_amnt = 0;
        $saleBill->slab_ref = 0;
        $saleBill->bill_naration = $bill_des;
        $saleBill->sale_type = $saletype;
        $saleBill->stateof_sp = $stateSale;
        $saleBill->bill_copy = implode(",", $imgData);
     
        $saleBill->cgst_sums = $cgstSum;
        $saleBill->sgst_sums = $sgstSum;
        $saleBill->igst_sums = $igstSum;
        $saleBill->gst_sums = $gstSum;

        $saleBill->cgst_sump = 0;
        $saleBill->sgst_sump = 0;
        $saleBill->igst_sump = 0;
        $saleBill->gst_sump = 0;

        $saleBill->exp_type = 0;
        

        $saleBill->save();
        $lastID = $saleBill->id;

        //   check wether the last inserted id is greater than 0
        if ($lastID > 0) {
            $FILENAME = 'SB' . str_repeat('0', (10) - strlen(rtrim($lastID))) . $lastID;

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
        return back()->with('success', 'Sale Bill Added Successfully');

    

    }


}
