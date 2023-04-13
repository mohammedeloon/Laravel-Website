<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    
    public function allCategory(){
       $blogCategory = BlogCategory::latest()->get();
       return  view('admin.blog_category.blog_category_all' , compact('blogCategory'));
    } // End method

    public function addCategory(){
        return view('admin.blog_category.add_blog_category');
    } // End method

    public function storeCategory(Request $request){
        $request->validate(
            [
                'blog_category' => 'required'
            ], [
                'blog_category.required' => 'Blog Category is Required'
            ]);

        BlogCategory::insert([
            'blog_category' => $request->blog_category,
            ]);

        $notification = array(
            'message'    => 'Blog Category Inserted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.blog.category')->with($notification);
    } // End method

    public function editCategory($id){
       $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.edit_blog_category' , compact('blogCategory'));
    }  // End method

    public function updateCategory(Request $request){
        $blogID = $request->id;
        $request->validate([
            'blog_category' => 'required'
        ],[
            'blog_category.required' => 'Blog category cannot be impty'
        ]);
        BlogCategory::findOrFail($blogID)->update([
            'blog_category'=> $request->blog_category
        ]);
        $notification = array(
            'message'    => 'Blog category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog.category')->with($notification);
    } //End method

    public function deleteCategory($id){
        BlogCategory::findOrFail($id)->delete();
        $notification  = array(
            'message'    => 'Blog Category Deleted Successfully' , 
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog.category')->with($notification);
    } // End method
}
