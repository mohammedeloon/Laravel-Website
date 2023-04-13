<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Image;
use Symfony\Component\HttpFoundation\RequestMatcher\PortRequestMatcher;

class PortfolioController extends Controller
{
    public function allPortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all' , compact('portfolio'));
    } // End method

    public function addPortfolio(){
        return view('admin.portfolio.add_portfolio'); 
    } // End method

    public function storePortfolio(Request $request){
        $request->validate([
          'portfolio_name'  => 'required',
          'portfolio_title' => 'required',
          'portfolio_image' => 'required',
          
        ],[
            'portfolio_name.required' => 'Portfolio name is required',
            'portfolio_title.required' => 'Portfolio title is required',
            'portfolio_image.required' => 'Portfolio image is required'
        ]);
        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
        Image::make($image)->resize(1020 , 519)->save('upload/portfolio/' . $name_gen);
        $save_url = 'upload/portfolio/' . $name_gen;

        Portfolio::insert([
            'portfolio_name'  => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_image' => $save_url,
            'portfolio_description' => $request->portfolio_description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'    => 'portfolio Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);
        

    } // End method

    public function editPortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));

    } // end method

    public function updatePortfolio(Request $request){
        $portfolio_id = $request->id;
        if($request->file('portfolio_image'))
        {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid().'.'.$image->getClientOriginalExtension()); // example : 3232144325.jpg 
            Image::make($image)->resize(1020 , 512)->save('upload/portfolio/'. $name_gen);
            $save_url = 'upload/portfolio/'.$name_gen;
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name'  => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_image' => $save_url,
                'portfolio_description' => $request->portfolio_description,
            ]);
            $notification = array(
                'message'    => 'Portfolio Updated Successfully with Image',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);

        }else
        {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name'  => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);
            $notification = array(
                'message'     => 'Home Slide Updated Without Image Successfully',
                'alert-type'  => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
         }

    } // End method

    public function deletePortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);
        Portfolio::findOrFail($id)->delete();
        $notification = array(
            'message'    => 'portfolio Deleted Successfully' , 
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    } // End method

    public function portfolioDetails($id){
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));
    } // End method

   
}