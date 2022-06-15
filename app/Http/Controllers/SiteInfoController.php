<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Image;

class SiteInfoController extends Controller
{
    //----siteinfo index--
    public function index(){
        $site_info = SiteInfo::first();
        return view('admin.site_info',[
            'site_info'=>$site_info,
        ]);
    }
    //----update--
    public function update(Request $request){
        $request->validate([
            'site_title'=>'required',
            'site_subtitle'=>'required',
            'copyright'=>'required',
        ]);
        if($request->logo == ''){
            SiteInfo::find($request->site_id)->update([
                'site_title'=>$request->site_title,
                'sub_title'=>$request->site_subtitle,
                'copyright'=>$request->copyright,
            ]);
            return back()->with('update', 'Site Info Update Success !...');
        }
        else{

            //---unlink preview logo--
            $logo_id = SiteInfo::find($request->site_id);
            $logo_name = $logo_id->logo;
            $old_logo_location = public_path('uploads/logo/'.$logo_name);
            unlink($old_logo_location);
            //--new logo upload--
            $logo_name = $request->logo;
            $logo_extension = $logo_name->extension();
            $new_logo_name =uniqid().'_logo_'.'.'.$logo_extension;
            Image::make($logo_name)->save(public_path('uploads/logo/'.$new_logo_name));

            SiteInfo::find($request->site_id)->update([
                'site_title'=>$request->site_title,
                'sub_title'=>$request->site_subtitle,
                'copyright'=>$request->copyright,
                'logo'=>$new_logo_name,
            ]);
            return back()->with('update', 'Site Info Update Success !...');

        }
    }
}
