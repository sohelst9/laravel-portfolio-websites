<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Address;
use App\Models\banner;
use App\Models\brand;
use App\Models\Education;
use App\Models\Funfact;
use App\Models\icon;
use App\Models\Portfolio;
use App\Models\Services;
use App\Models\SiteInfo;
use App\Models\Testimonail;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $banner_info = banner::where('status', '=', 1)->first();
        $about_info = About::where('status', '=', 1)->first();
        $education_info = Education::all();
        $services_info = Services::all();
        $portfolio_info = Portfolio::all();
        $funfact_info = Funfact::all();
        $testimonail_info = Testimonail::all();
        $brand_info = brand::all();
        $address_info = Address::first();
        $site_info = SiteInfo::first();
        $icon_info = icon::all();
        return view('frontend.index',[
            'banner_info'=>$banner_info,
            'about_info'=>$about_info,
            'education_info'=>$education_info,
            'services_info'=>$services_info,
            'portfolio_info'=>$portfolio_info,
            'funfact_info'=>$funfact_info,
            'testimonail_info'=>$testimonail_info,
            'brand_info'=>$brand_info,
            'address_info'=>$address_info,
            'site_info'=>$site_info,
            'icon_info'=>$icon_info,
        ]);
    }
    //----portfolio_single
    public function portfolio_single($portfolio_id){
        $portfolio_id_info = Portfolio::find($portfolio_id);
        return view('frontend.single_page',[
            'portfolio_id_info'=>$portfolio_id_info,
        ]);
    }
}
