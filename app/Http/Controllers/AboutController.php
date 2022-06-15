<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class AboutController extends Controller
{
    public function add_about(){
        return view('admin.abouts.add_about');
    }

    // insert_about
    public function insert_about(Request $request){

        // form validation----
        $request->validate([
            'sub_title'=>'required',
            'title'=>'required',
            'description'=>'required',
            'about_image'=>'required|mimes:png,jpg,jpej',
        ],[
            'sub_title.required'=>'* This Field is Required',
            'title.required'=>'* This Field is Required',
            'description.required'=>'* This Field is Required',
            'about_image.required'=>'* please select your file ',
        ]);

        $about_image = $request->about_image;
        $image_extension = $about_image->extension();
        $new_image_name = uniqid().'about'.'.'.$image_extension;
        Image::make($about_image)->save(public_path('uploads/abouts/'.$new_image_name));

        $user_id = Auth::user()->id;
        About::insert([
            'user_id'=>$user_id,
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'description'=>$request->description,
            'about_image'=>$new_image_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('about_success', 'About Insert Successfully !..');

    }
    // view_about---
    public function view_about(){
        $all_about = About::all();
        return view('admin.abouts.view_about',[
            'all_about'=>$all_about,
        ]);
    }
    // edit_about--
    public function edit_about($about_id){
        $about_id_info =About::find($about_id);
        return view('admin.abouts.edit_about',[
            'about_id_info'=>$about_id_info,
        ]);
    }
    // update_about--
    public function update_about(Request $request){
        $request->validate([
           'sub_title'=>'required',
           'title'=>'required',
           'description'=>'required',
        ]);

        if($request->about_image == ''){
            About::find($request->about_id)->update([
                'sub_title'=>$request->sub_title,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
            return redirect(route('view.about'))->with('about_update', 'About Update Successfully !...');
        }
        else{
            $request->validate([
                'about_image'=>'required|mimes:png,jpg,jpeg',
            ]);
            // unlink about image
            $about_id = About::find($request->about_id);
            $about_image_name = $about_id->about_image;
            $image_location = public_path('uploads/abouts/'.$about_image_name);
            unlink($image_location);

            // new image uploads--
            $image_name = $request->about_image;
            $image_extension = $image_name->extension();
            $new_image_name = uniqid().'about'.'.'.$image_extension;
            Image::make($image_name)->save(public_path('uploads/abouts/'.$new_image_name));

            // update about--
            About::find($request->about_id)->update([
                'sub_title'=>$request->sub_title,
                'title'=>$request->title,
                'description'=>$request->description,
                'about_image'=>$new_image_name,

            ]);
            return redirect(route('view.about'))->with('about_update', 'About Update Successfully !...');
        }
    }
    // change_status--
    public function change_status($about_id){
        $get_status = About::select('status')->where('id', $about_id)->first();
        if($get_status->status == 1){
            $status = 0;
        }
        else{
            $status = 1;
        }
        About:: where('id',$about_id)->update([
            'status'=>$status,
        ]);
        return back();
    }
    //delete_about
    public function delete_about($about_id){
       // unlink about image---
       $about_id2 = About::find($about_id);
       $about_image_name = $about_id2->about_image;
       $delete_image_location = public_path('uploads/abouts/'.$about_image_name);
       unlink($delete_image_location);

       About::find($about_id)->delete();
       return back()->with('about_delete', 'About Delete Successfully !..');
    }
}
