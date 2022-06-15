<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    // add_education--
    public function add_education(){
        return view('admin.education.add_edu');
    }
    // insert_edu--
    public function insert_edu(Request $request){
        $request->validate([
            'year'=>'required',
            'description'=>'required',
            'skill'=>'required',
        ]);
        $user_id = Auth::user()->id;
        Education::insert([
            'user_id'=>$user_id,
            'year'=>$request->year,
            'description'=>$request->description,
            'skill'=>$request->skill,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('edu_success', 'Education data Insert Successfully !..');
    }
    //view_edu -----
    public function view_edu(){
        $all_education = Education::all();
        return view('admin.education.view_edu',[
            'all_education'=>$all_education,
        ]);
    }
    //---edit_edu
    public function edit_edu($education_id){
        $edu_id_info = Education::find($education_id);
        return view('admin.education.edit_edu',[
            'edu_id_info'=>$edu_id_info,
        ]);
    }

    //----edu_update---
    public function edu_update(Request $request){
        $request->validate([
            'year'=>'required',
            'description'=>'required',
            'skill'=>'required',
        ]);

        Education::find($request->edu_id)->update([
            'year'=>$request->year,
            'description'=>$request->description,
            'skill'=>$request->skill,
        ]);
        return redirect(route('view.edu'))->with('edu_update', 'Education Data Update Successfully !..');
    }

    //----change_status--
    public function change_status($education_id){
        $get_status = Education::select('status')->where('id',$education_id)->first();
        if($get_status->status == 1){
            $status = 0;
        }
        else{
            $status =1;
        }
        Education::where('id',$education_id)->update([
            'status'=>$status,
        ]);
        return back();
    }
    // ----delete_edu--
    public function delete_edu($education_id){
        Education::where('id', $education_id)->delete();
        return back()->with('delete_edu','Education Data Delete Successfully');
    }
}
