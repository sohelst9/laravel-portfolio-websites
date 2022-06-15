<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class BannerController extends Controller
{
    public function add_banner(){
        return view('admin.banners.add_banner');
    }

    //banner_insert
    public function banner_insert(Request $request){
        $request->validate([
            'sub_title'=>'required',
            'title'=>'required',
            'description'=>'required',
            'banner_image'=>'required|mimes:jpg,jpeg,png',

        ]);

        $image = $request->banner_image;
        $image_extension= $image->getClientOriginalExtension();
        $image_name = uniqid().'banner'.'.'.$image_extension;
        Image::make($image)->save(public_path('uploads/banners/'.$image_name));

        $user_id = Auth::user()->id;

        banner::insert([
            'user_id'=>$user_id,
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'description'=>$request->description,
            'banner_image'=>$image_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('insert_success', 'Banner Insert Successfully !');
    }

    // view_banner
    public function view_banner(){
        $all_banner= banner::all();
        return view('admin.banners.view_banner', [
            'all_banner'=>$all_banner,
        ]);
    }

    // edit_banner
    public function edit_banner($banner_id){
        $banner_id_info = banner::find($banner_id);
        return view('admin.banners.edit_banner',[
            'banner_id_info'=>$banner_id_info,
        ]);
    }
    //update_banner
    public function update_banner(Request $request){
        $request->validate([
            'sub_title'=>'required',
            'title'=>'required',
            'description'=>'required',
        ]);
        if($request->banner_image == ''){
            banner::find($request->banner_id)->update([
                'sub_title'=>$request->sub_title,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
            return redirect(route('view.banner'))->with('update_success', 'Banner Update Successfully !..');
        }
        else{
            // validate image field
            $request->validate([
                'banner_image'=>'required|mimes:jpg,jpeg,png',
            ]);
           // unlink banner image---
           $banner_id = banner::find($request->banner_id);
           $banner_image_name =$banner_id->banner_image;
           $banner_image_location = public_path('uploads/banners/'.$banner_image_name);
           unlink($banner_image_location);

           // upload new Image---
           $image = $request->banner_image;
           $image_extension = $image->extension();
           $new_image_name = uniqid().'banner'.'.'.$image_extension;
           Image::make($image)->save(public_path('/uploads/banners/'.$new_image_name));

           // update banner
           banner::find($request->banner_id)->update([
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'description'=>$request->description,
            'banner_image'=>$new_image_name,
           ]);
           return redirect(route('view.banner'))->with('update_success', 'Banner Update Successfully !..');
        }
    }

    // change_status---
    public function change_status($banner_id){
        $get_status = banner::select('status')->where('id',$banner_id)->first();
        if($get_status->status == 1){
            $status = 0;
        }
        else{
            $status = 1;
        }
        banner::where('id', $banner_id)->update([
            'status'=>$status,
        ]);
        return back();
    }
    // delete_banner

    public function delete_banner($banner_id){
        // unlink banner image
        $banner_id2 = banner::find($banner_id);
        $image_name = $banner_id2->banner_image;
        $image_location = public_path('/uploads/banners/'.$image_name);
        unlink($image_location);
        // delete banner

        banner::find($banner_id)->delete();
        return back()->with('delete_success', 'Banner delete Sucessfully !..');
    }
}
