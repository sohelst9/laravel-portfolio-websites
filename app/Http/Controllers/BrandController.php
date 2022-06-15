<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class BrandController extends Controller
{
    //---add_brand
    public function add_brand(){
        return view('admin.brand.add_brand');
    }
    //--insert_brand
    public function insert_brand(Request $request){
        $request->validate([
            'brand_image'=>'required|mimes:png,jpg,jpeg',
        ]);
        $image_name =$request->brand_image;
        $image_extension = $image_name->extension();
        $new_image_name = uniqid().'brand'.'.'.$image_extension;
        Image::make($image_name)->save(public_path('uploads/brand/'.$new_image_name));

        $user_id = Auth::user()->id;
        brand::insert([
            'user_id'=>$user_id,
            'brand_image'=>$new_image_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Brand Insert Successfully !.');
    }
    //----view_brand
    public function view_brand(){
        $all_brand = brand::all();
        return view('admin.brand.view_brand',[
            'all_brand'=>$all_brand,
        ]);
    }
    //---edit_brand
    public function edit_brand($brand_id){
        $brand_id_info = brand::find($brand_id);
        return view('admin.brand.edit_brand',[
            'brand_id_info'=>$brand_id_info,
        ]);
    }
    //---update_brand--
    public function update_brand(Request $request){
        $request->validate([
            'brand_image'=>'required|mimes:png,jpg,jpeg',
        ]);
        //---image unlink
        $brand_image_id = brand::find($request->brand_id);
        $image_name = $brand_image_id->brand_image;
        $old_image_location = public_path('uploads/brand/'.$image_name);
        unlink($old_image_location);

        //new image upload--
        $brand_image_name =$request->brand_image;
        $brand_image_extension = $brand_image_name->extension();
        $new_bimage_name = uniqid().'brands'.'.'.$brand_image_extension;
        Image::make($brand_image_name)->save(public_path('uploads/brand/'.$new_bimage_name));

        brand::find($request->brand_id)->update([
            'brand_image'=>$new_bimage_name,
        ]);
        return redirect(route('view.brand'))->with('update','Brand Update Successfully !');
    }
    //---delete_brand--
    public function delete_brand($brand_id){
        $brand_image_id = brand::find($brand_id);
        $image_name = $brand_image_id->brand_image;
        $old_image_location = public_path('uploads/brand/'.$image_name);
        unlink($old_image_location);

        brand::find($brand_id)->delete();
        return redirect(route('view.brand'))->with('delete','Brand delete Successfully !');
    }
}
