<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Carbon\Carbon;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Whoops\Run;
use Image;

class PortfolioController extends Controller
{
    //--add_category
    public function add_category(){
        return view('admin.portfolio.category.add_category');
    }
    //--category_insert
    public function category_insert(Request $request){
        $request->validate([
            'category'=>'required',
        ]);
        $user_id = Auth::id();
        Category::insert([
            'user_id'=>$user_id,
            'category'=>$request->category,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Category Insert Successfully !..');
    }
    //--view_category
    public function view_category(){
        $all_category = Category::all();
        return view('admin.portfolio.category.view_category',[
            'all_category'=>$all_category,
        ]);
    }

    // edit_category--
    public function edit_category($category_id){
        $category_id_info = Category::find($category_id);
        return view('admin.portfolio.category.edit_category',[
            'category_id_info'=>$category_id_info,
        ]);
    }

    // update_category
    public function update_category(Request $request){
        $request->validate([
            'category'=>'required',
        ]);
        Category::find($request->category_id)->update([
            'category'=>$request->category,
        ]);
        return redirect(route('view.category'))->with('success', 'Category Update Successfully !..');
    }
    //--delete_category
    public function delete_category($category_id){
        Category::find($category_id)->delete();
        return redirect(route('view.category'))->with('delete', 'Category Delete Successfully !..');
    }


    //-------add_portfolio-----
    public function add_portfolio(){
        $all_category_info= Category::all();
        return view('admin.portfolio.add_portfolio',[
            'all_category_info'=>$all_category_info,
        ]);
    }
    //---insert_portfolio--
    public function insert_portfolio(Request $request){
        $request->validate([
            'category_id'=>'required',
            'title'=>'required',
            'sub_title'=>'required',
            'description'=>'required',
            'Portfolio_image'=>'required|mimes:png,jpg,jpeg',
        ]);
        $image_name =$request->Portfolio_image;
        $image_extension = $image_name->extension();
        $new_image_name = uniqid().'portfolio'.'.'.$image_extension;
        Image::make($image_name)->save(public_path('/uploads/portfolio/'.$new_image_name));

        $user_id = Auth::user()->id;
        Portfolio::insert([
            'user_id'=>$user_id,
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'sub_title'=>$request->sub_title,
            'description'=>$request->description,
            'image'=>$new_image_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Portfolio Insert Successfully !..');

    }
    //---view_portfolio--
    public function view_portfolio(){
        $all_portfolio = Portfolio::all();
        return view('admin.portfolio.view_portfolio',[
            'all_portfolio'=>$all_portfolio,
        ]);
    }

    public function edit_portfolio($portfolio_id){
        $portfolio_id_info = Portfolio::find($portfolio_id);
        $all_category_info= Category::all();
        return view('admin.portfolio.edit_portfolio',[
            'portfolio_id_info'=>$portfolio_id_info,
            'all_category_info'=>$all_category_info,
        ]);
    }
    //---update_portfolio--
    public function update_portfolio(Request $request){
        $request->validate([
            'category_id'=>'required',
            'title'=>'required',
            'sub_title'=>'required',
            'description'=>'required',
        ]);
        if($request->Portfolio_image == ''){
            Portfolio::where('id', $request->portfolio_id)->update([
                'category_id'=>$request->category_id,
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'description'=>$request->description,
            ]);
            return redirect(route('view.portfolio'))->with('success', 'Portfolio Update Successfully !..');
        }
        else{
            $request->validate([
                'Portfolio_image'=>'required|mimes:png,jpg,jpeg',
            ]);
            $portfolio_id = Portfolio::find($request->portfolio_id);
            $image_name = $portfolio_id->image;
            $image_location = public_path('uploads/portfolio/'.$image_name);
            unlink($image_location);

            $image_name = $request->Portfolio_image;
            $image_extension =$image_name->getClientOriginalExtension();
            $new_image_name = uniqid().'portfolios'.'.'.$image_extension;
            Image::make($image_name)->save(public_path('uploads/portfolio/'.$new_image_name));

            Portfolio::find($request->portfolio_id)->update([
                'category_id'=>$request->category_id,
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'description'=>$request->description,
                'image'=>$new_image_name,
            ]);
            return redirect(route('view.portfolio'))->with('success', 'Portfolio Update Successfully !..');
        }
    }

    //----delete_portfolio--
    public function delete_portfolio($portfolio_id){
        $portfolio_id2 = Portfolio::find($portfolio_id);
        $Port_image_name = $portfolio_id2->image;
        $port_image_location = public_path('uploads/portfolio/'.$Port_image_name);
        unlink($port_image_location);

        Portfolio::find($portfolio_id)->delete();
        return back()->with('delete', 'Portfolio Delete Successfully !...');
    }

}
