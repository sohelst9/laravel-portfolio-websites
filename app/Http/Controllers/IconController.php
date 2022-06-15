<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IconController extends Controller
{
    //----add_icon---
    public function add_icon(){
        $all_font = fa_icons();
        return view('admin.icon.add_icon',[
            'all_font'=>$all_font,
        ]);
    }

    // insert_icon---
    public function insert_icon(Request $request){
        $request->validate([
            'class_name'=>'required',
        ]);
        $user_id = Auth::id();
        Icon::insert([
            'user_id'=>$user_id,
            'icon_class'=>$request->class_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Icon Insert Successfully!..');
    }

    //---view_icon
    public function view_icon(){
        $all_icon = Icon::all();
        return view('admin.icon.view_icon',[
            'all_icon'=>$all_icon,
        ]);
    }
    //---edit_icon
    public function edit_icon($icon_id){
        $icon_id_info = Icon::find($icon_id);
        $all_font = fa_icons();
        return view('admin.icon.edit_icon',[
            'icon_id_info'=>$icon_id_info,
            'all_font'=>$all_font,
        ]);
    }
    //---update_icon
    public function update_icon(Request $request){
        $request->validate([
            'class_name'=>'required',
        ]);

        Icon::find($request->icon_id)->update([
            'icon_class'=>$request->class_name,
        ]);
        return redirect(route('view.icon'))->with('update','Icon update Successfully!..');
    }
    //---delete_icon
    public function delete_icon($icon_id){
        Icon::find($icon_id)->delete();
        return redirect(route('view.icon'))->with('delete','Icon delete Successfully!..');
    }
}
