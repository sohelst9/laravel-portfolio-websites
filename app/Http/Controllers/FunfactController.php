<?php

namespace App\Http\Controllers;

use App\Models\Funfact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FunfactController extends Controller
{
    public function add_funfact(){
        $all_font = fa_icons();
        return view('admin.funfact.add_funfact',[
            'all_font'=> $all_font,
        ]);
    }
    //--insert_funfact
    public function insert_funfact(Request $request){
        $request->validate([
            'icon'=>'required',
            'title'=>'required',
            'counter_num'=>'required',
        ]);
        $user_id = Auth::user()->id;
        Funfact::insert([
            'user_id'=>$user_id,
            'icon'=>$request->icon,
            'title'=>$request->title,
            'counter_num'=>$request->counter_num,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Funfact Insert Successfully !..');
    }

    //---view_funfact
    public function view_funfact(){
        $all_funfact = Funfact::all();
        return  view('admin.funfact.view_funfact',[
            'all_funfact'=>$all_funfact,
        ]);
    }

    //--edit_funfact
    public function edit_funfact($funfact_id){
        $funfact_id_info = Funfact::find($funfact_id);
        $all_font = fa_icons();
        return view('admin.funfact.edit_funfact',[
            'funfact_id_info'=>$funfact_id_info,
            'all_font'=>$all_font,
        ]);
    }
    //--update_funfact
    public function update_funfact(Request $request){
        $request->validate([
            'icon'=>'required',
            'title'=>'required',
            'counter_num'=>'required',
        ]);
        Funfact::find($request->funfact_id)->update([
            'icon'=>$request->icon,
            'title'=>$request->title,
            'counter_num'=>$request->counter_num,
        ]);
        return redirect(route('view.funfact'))->with('update','Funfact Update Successfully !..');
    }
    //----delete_funfact
    public function delete_funfact($funfact_id){
        Funfact::find($funfact_id)->delete();
        return redirect(route('view.funfact'))->with('delete','Funfact delete Successfully !..');
    }
}
