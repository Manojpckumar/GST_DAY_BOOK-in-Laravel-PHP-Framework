<?php

namespace App\Http\Controllers;

use App\Models\AllBills;
use App\Models\BillSlabs;
use App\Models\Store;


class BillController extends Controller
{
    function viewbilldetails($id)
    {

        $slab_re = AllBills::where('id', '=', $id)->pluck('slab_ref');
        $slab_ref = $slab_re[0];


        $data = [
            'LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(),

            'billDetails' => AllBills::all()
                ->where('id', '=', $id),

            'gstDetails' => BillSlabs::all()
                            ->where('slab_ref', '=',$slab_ref)

        ];
        return view('admin.billdetail',$data);
        //return $data;
    }
}
