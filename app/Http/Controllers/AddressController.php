<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //----address index---
    public function index(){
        $address = Address::first();
        return view('admin.address.address',[
            'address'=>$address,
        ]);
    }
    //---address_update--
    public function address_update(Request $request){
        $request->validate([
            'sub_title'=>'required',
            'title'=>'required',
            'description'=>'required',
            'office_loc'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);
        Address::find($request->address_id)->update([
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'desc'=>$request->description,
            'office_loc'=>$request->office_loc,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ]);
        return back()->with('update','Address Update Successfully !...');
    }
}
