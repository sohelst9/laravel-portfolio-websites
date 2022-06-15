<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    //----add_services--
    public function add_services(){
        $all_font = fa_icons();
        return view('admin.services.add_services',[
            'all_font'=>$all_font,
        ]);
    }
    //-- insert_services
    public function insert_services(Request $request){
        $request->validate([
            'services_icon'=>'required',
            'title'=>'required',
            'description'=>'required',
        ]);
        $user_id = Auth::user()->id;
        Services::insert([
            'user_id'=>$user_id,
            'icon'=>$request->services_icon,
            'title'=>$request->title,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Services Insert Successfully !.. ');

    }
    public function view_services(){
        $all_services = Services::all();
        return view('admin.services.view_services',[
            'all_services'=>$all_services,
        ]);
    }
    public function edit_services($services_id){
        $services_id_info = Services::find($services_id);
        $all_font = fa_icons();
        return view('admin.services.edit_services',[
            'all_font'=>$all_font,
            'services_id_info'=>$services_id_info,
        ]);
    }
    //---update_services
    public function update_services(Request $request){
        $request->validate([
            'services_icon'=>'required',
            'title'=>'required',
            'description'=>'required',
        ]);
        Services::find($request->services_id)->update([
            'icon'=>$request->services_icon,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect(route('view.services'))->with('update', 'Services update successfully !..');
    }

    //----delete_services
    public function delete_services($services_id){
        Services::find($services_id)->delete();
        return redirect(route('view.services'))->with('delete', 'Services delete successfully !..');
    }

}
