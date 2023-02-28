<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Image;

class aboutController extends Controller
{
   public function aboutPage()
   {
        $aboutPage = About::find(1);
        return view( 'admin.about_page.about_page_all', compact('aboutPage'));
   } // end method

   public function updateAbout(Request $request)
   {
         $aboutPage_id = $request->id;
         if ($request->file('about_image')) {
            $image    = $request->file('about_image');
            $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
            Image::make($image)->resize(523, 605)->save('upload/about_images/' . $name_gen);
            $save_url = 'upload/about_images'  . $name_gen;
            About::findOrFail($aboutPage_id)->update([
                  'title'               =>   $request->title,
                  'short_title'         =>   $request->short_title,
                  'short_description'   =>   $request->short_description,
                  'long_description'    =>   $request->long_description ,
                  'about_image'        =>   $save_url ,
            ]);
            $notification = array(
               'message'    => 'About Part Updated Successfully' , 
               'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

         }else{
            About::findOrFail($aboutPage_id)->update([
               'title'               =>   $request->title,
               'short_title'         =>   $request->short_title,
               'short_description'   =>   $request->short_description,
               'long_description'    =>   $request->long_description ,
            ]);
            $notification = array(
               'message'    => 'About Part Updated Without Image Successfully' , 
               'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);


         } // end else

   } // end method

   public function homeAbout()
   {
      $aboutPage = About::find(1);
      return view('frontend.about_page', compact('aboutPage'));
   } // end method

}