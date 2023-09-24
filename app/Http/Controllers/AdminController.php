<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('/admin.index');
    } //end method;

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//end method;

    public function AdminLogin(){
        return view('admin.admin_login');
    }//end method;

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }//end method;

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        // dd($request->all());
        $data->name = $request->name;
        
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            // Update new photo instead of previous uploaded photo;
            @unlink(public_path('uploads/admin_images/' . $data->photo));

            $filename = date('Y-M-D-').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method;

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
        
    }//end method;

    public function AdminUpdatePassword(Request $request){

        // apply validation on fields
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // match old password
        if( !Hash::check($request->current_password, auth::user()->password)){
            $notification = array(
                'message' => 'Current password does not match!',
                'alert-type' => 'error'
            );
    
            return back()->with($notification);
        }
        // Update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password change successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }//end method;

    

}

