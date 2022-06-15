<?php

namespace App\Http\Controllers;

use App\Models\Testimonail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class TestimonailController extends Controller
{
    //----------add testimonail
    public function add_testimonail(){
        return view('admin.testimonail.add_testimonial');
    }
    //----insert testimonail
    public function insert_testimonail(Request $request){
        $request->validate([
            'client_name'=>'required',
            'designation'=>'required',
            'client_review'=>'required',
            'client_image'=>'required|mimes:png,jpg,jpeg',
        ]);
        $client_image = $request->client_image;
        $image_extension = $client_image->extension();
        $new_image_name = uniqid().'testi'.'.'.$image_extension;
        Image::make($client_image)->save(public_path('uploads/testimonail/'.$new_image_name));

        $user_id = Auth::user()->id;
        Testimonail::insert([
            'user_id'=>$user_id,
            'clent_name'=>$request->client_name,
            'designation'=>$request->designation,
            'client_review'=>$request->client_review,
            'client_image'=>$new_image_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Testimonail Insert Successfully !..');
    }
    //-----view_testimonail
    public function view_testimonail(){
        $all_testimonail = Testimonail::all();
        return view('admin.testimonail.view_testimonial',[
            'all_testimonail'=>$all_testimonail,
        ]);
    }
    //---edit_testimonail--
    public function edit_testimonail($testi_id){
        $testi_id_info = Testimonail::find($testi_id);
        return view('admin.testimonail.edit_testimonail',[
            'testi_id_info'=>$testi_id_info,
        ]);
    }
    //---update_testimonail
    public function update_testimonail(Request $request){
        $request->validate([
            'client_name'=>'required',
            'designation'=>'required',
            'client_review'=>'required',
        ]);
        if($request->client_image == ''){
            Testimonail::find($request->testi_id)->update([
                'clent_name'=>$request->client_name,
                'designation'=>$request->designation,
                'client_review'=>$request->client_review,
            ]);
            return redirect(route('view.testi'))->with('update', 'Testimonail Update Successfully');
        }
        else{
            $request->validate([
                'client_image'=>'required|mimes:png,jpg,jpeg',
            ]);
            //--image unlink--
            $image_id = Testimonail::find($request->testi_id);
            $testi_image_name = $image_id->client_image;
            $old_image_location = public_path('uploads/testimonail/'.$testi_image_name);
            unlink($old_image_location);


            //--image upload--
            $image_name = $request->client_image;
            $image_extension = $image_name->extension();
            $new_image_name = uniqid().'testimo'.'.'.$image_extension;
            Image::make($image_name)->save(public_path('uploads/testimonail/'.$new_image_name));

            Testimonail::find($request->testi_id)->update([
                'clent_name'=>$request->client_name,
                'designation'=>$request->designation,
                'client_review'=>$request->client_review,
                'client_image'=>$new_image_name,
            ]);
            return redirect(route('view.testi'))->with('update', 'Testimonail Update Successfully');
        }
    }
    //----delete_testimonail
    public function delete_testimonail($testi_id){
        $testi_id1 = Testimonail::find($testi_id);
        $image_name = $testi_id1->client_image;
        $image_location = public_path('uploads/testimonail/'.$image_name);
        unlink($image_location);

        Testimonail::find($testi_id)->delete();
        return redirect(route('view.testi'))->with('delete', 'Testimonail delete Successfully');
    }
}
