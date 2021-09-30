<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Gstr;
use Illuminate\Http\Request;

class GstrController extends Controller
{
    function addgstrtype()
    {
        $data = ['LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.addgstrtype', $data);
    }

    function creategstslab(Request $request)
    {

     

        // checkslab exist or not ?
        $count = Gstr::where('gstr', '=', $request->gstr)->count();

        if ($count == 0) {  
           // insert data into db
           $gstslab = new Gstr();
           $gstslab->gstr = $request->gstr;
           $save = $gstslab->save();

           if ($save) {
               //return redirect('/admin/addstore')->with('success','Store created Successfully');
               return back()->with('success', 'Slab created Successfully');
           } else {
               return back()->with('fail', 'Something went wrong');
           }
        } else {
            return back()->with('fail', 'Slab already exist');
        }
    }


    function managegstslabs()
    {
        $data = ['LoggedUserInfo' => Store::where('id', '=', session('LoggedUser'))->first(), 'slabs' => Gstr::all()];
        return view('admin.manageslabs', $data);
    }

    function removeslab($id)
    {
        $gstslab = Gstr::find($id);
        $gstslab->delete();
        return back()->with('success', 'GST Slab Deleted Successfully');
    }
}
