<?php

namespace App\Http\Controllers;

use App\Models\AllBills;
use App\Models\Expences;
use App\Models\Gstr;
use App\Models\SaleBill;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class DayBookController extends Controller
{

  function viewDayBook()
  {
    $data = ['LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(), 'stores' => Store::where('s_name', '!=', 'Admin')->get()];
    return view('admin.viewDayBook', $data);
  }


  function viewStoreDayBook($id)
  {
    $store_code = Store::where('id', '=', $id)->pluck('store_code');
    $st = $store_code[0];

    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),



      'sale' => AllBills::select(
        "all_bills.store_code",
        "all_bills.bill_date",
        "stores.s_name",
        DB::raw("SUM(all_bills.sbill_amnt) as sale_amnt"),
        DB::raw("SUM(all_bills.pbill_amnt) as pur_amnt"),
        DB::raw("SUM(all_bills.ebill_amnt) as exp_amnt")
      )
        ->join('stores', 'all_bills.store_code', '=', 'stores.store_code')
        ->groupBy('all_bills.bill_date')
        ->where(['all_bills.store_code' => $st])
        ->get()

    ];

    return view('admin.storedaybook', $data);
    //return $data;

  }


  function viewExpandedDayBook($stc, $bdat)
  {

    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),

      'expandedBook' => AllBills::all()
        ->where('store_code', '=', $stc)
        ->where('bill_date', '=', $bdat)


    ];

    return view('admin.ExpandedDayBook', $data);
    //return $data;

  }

  // store day book individual view

  function viewIndividualDayBook()
  {
    $store_code = Store::where('id', '=', session('LoggedUser'))->pluck('store_code');

    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),


      'sale' => AllBills::select(
        "all_bills.store_code",
        "all_bills.bill_date",
        "stores.s_name",
        DB::raw("SUM(all_bills.sbill_amnt) as sale_amnt"),
        DB::raw("SUM(all_bills.pbill_amnt) as pur_amnt"),
        DB::raw("SUM(all_bills.ebill_amnt) as exp_amnt")
      )
        ->join('stores', 'all_bills.store_code', '=', 'stores.store_code')
        ->groupBy('all_bills.bill_date')
        ->where(['all_bills.store_code' => $store_code[0]])
        ->get()

    ];

    return view('admin.storedaybook', $data);
    //return $data;

  }

  // view expanded day book store 

  function viewStoreExpandedDayBook($stc, $bdat)
  {

    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),

      'expandedBook' => AllBills::all()
        ->where('store_code', '=', $stc)
        ->where('bill_date', '=', $bdat)


    ];

    return view('admin.storeexpandeddaybook', $data);
    //return $data;

  }

  // report individual store 
  function storeindividualReport($id)
  {
    $store_code = Store::where('id', '=', $id)->pluck('store_code');
    $st = $store_code[0];

    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),


      'sale' => AllBills::select(
        "all_bills.*",
        "stores.s_name",
        DB::raw("SUM(all_bills.sbill_amnt) as sale_amnt"),
        DB::raw("SUM(all_bills.pbill_amnt) as pur_amnt"),
        DB::raw("SUM(all_bills.ebill_amnt) as exp_amnt"),

        DB::raw("SUM(all_bills.gst_sums) as sale_gstsum"),
        DB::raw("SUM(all_bills.gst_sump) as pur_gstsum")

      )
        ->join('stores', 'all_bills.store_code', '=', 'stores.store_code')
        ->groupBy('all_bills.bill_date')
        ->where(['all_bills.store_code' => $st])
        // ->whereNotBetween()
        ->get()

    ];

    return view('admin.daybookreport', $data);
    //return $data;

  }

  function viewStoreDailyReport(Request $request)
  {



    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),

     
      'storeName' => Store::where('store_code', '=', $request->store_Code)->pluck('s_name'),

      'dailyReport' => AllBills::select(
        "all_bills.*",
        "stores.s_name",
        DB::raw("SUM(all_bills.sbill_amnt) as sale_amnt"),
        DB::raw("SUM(all_bills.pbill_amnt) as pur_amnt"),
        DB::raw("SUM(all_bills.ebill_amnt) as exp_amnt"),

        DB::raw("SUM(all_bills.gst_sums) as sale_gstsum"),
        DB::raw("SUM(all_bills.gst_sump) as pur_gstsum")

      )
        ->join('stores', 'all_bills.store_code', '=', 'stores.store_code')
        // ->groupBy('all_bills.bill_date')
        ->where(['all_bills.store_code' => $request->store_Code, 'all_bills.bill_date' => $request->selectDate])
        // ->whereNotBetween()
        ->get(),

      'alltrans' => AllBills::where(['store_code' => $request->store_Code, 'bill_date' => $request->selectDate])
        ->get(),

      'dates' => $request->selectDate


    ];

    return view('admin.storeDailyReport', $data);
  }


  function viewStoreMonthlyReport(Request $request)
  {
    $data = [
      'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),

      'storeName' => Store::where('store_code', '=', $request->storeCODE)->pluck('s_name'),

      'monthlyReport' => AllBills::select(
        "all_bills.*",
        "stores.s_name",
        DB::raw("SUM(all_bills.sbill_amnt) as sale_amnt"),
        DB::raw("SUM(all_bills.pbill_amnt) as pur_amnt"),
        DB::raw("SUM(all_bills.ebill_amnt) as exp_amnt"),

        DB::raw("SUM(all_bills.gst_sums) as sale_gstsum"),
        DB::raw("SUM(all_bills.gst_sump) as pur_gstsum")

      )
        ->join('stores', 'all_bills.store_code', '=', 'stores.store_code')
        // ->groupBy('all_bills.bill_date')
        ->where('all_bills.store_code', '=' ,$request->storeCODE)
        ->whereDate('all_bills.bill_date', '>=' ,$request->fromDate)
        ->whereDate('all_bills.bill_date', '<=' ,$request->toDate)
       
        // ->whereNotBetween()
        ->get(),

      'alltrans' => AllBills::where('store_code', '=' ,$request->storeCODE)
      ->whereDate('all_bills.bill_date', '>=' ,$request->fromDate)
      ->whereDate('all_bills.bill_date', '<=' ,$request->toDate)
        ->get()

     


    ];

    return view('admin.storeMonthlyReport', $data);
      //return $data;
    //return $request->store_Code;
  }



  // function viewAllStoreDayBook($id)
  // {

  //     $store_code = Store::where('id', '=', $id)->pluck('store_code');
  //     $st = $store_code[0];

  //     $data = [
  //           'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),

  //           'sale' =>   DB::table('sale_bills')
  //           ->select('sale_bills.*','')
  //           ->distinct()
  //           ->join('sale_bill_slabs','sale_bills.ref_invnum','=','sale_bill_slabs.inv_noref')
  //           ->where(['sale_bills.store_code' => $st])
  //           ->get(),

  //           'purchase' =>  DB::table('purchase_bills')
  //           ->select('purchase_bills.*')
  //           ->distinct()
  //           ->join('purchase_bill_slabs','purchase_bills.ref_invnum','=','purchase_bill_slabs.inv_noref')
  //           ->where(['purchase_bills.store_code' => $st])
  //           ->get(),

  //           'expenses' => DB::table('expences')
  //           ->where('store_code',$st)
  //           ->get()


  //     ];

  //      return view('admin.storedaybook',$data);
  //     return $data;

  // }


}
