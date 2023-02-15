<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }//end method 

    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view' , compact('adminData'));
        // $user = auth()->user();
        // $id = optional($user)->id;
    
        // if (!$id) {
        //     // Handle the case where the user is not authenticated
        //     return redirect()->route('login');
        // }
    
        // $editData = User::find($id);
    
        // if (!$editData) {
        //     // Handle the case where the user is authenticated but the user record is not found
        //     return redirect()->back()->withErrors(['error' => 'User not found']);
        // }
    
        // return view('admin.admin_profile_edit', compact('editData'));
    
    } //end method 

    public function editProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit' , compact('editData'));
    } //end method

    public function storeProfile(Request $request){
        $id   = Auth::user()->id;
        $data = User::find($id);
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->username = $request->username;

        if($request->file('profile_image')){
            $file     = $request->file('profile_image');
            $filename = date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images') , $filename);
            $data['profile_image'] = $filename;

    } 
    $data->save();
    $notification = array(
        'message' => 'Admin Profile Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.profile')->with($notification);
}
}
