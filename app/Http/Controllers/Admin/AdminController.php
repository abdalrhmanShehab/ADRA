<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use File;
use Image;
use Session;
use Auth;
use Hash;

class AdminController extends Controller
{

    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings(){
        Session::put('page','settings');
        $admindetails = Auth::guard('admin')->user();
        return view('admin.admin_settings',compact('admindetails'));
    }

    public function checkCurrentPassword(Request $request){
        $data= $request->all();

        $password = Auth::guard('admin')->user()->password;

        if (Hash::check($data['current_pwd'], $password)) {
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function updatepassword(Request $request){
        $data = $request->all();
        $password = Auth::guard('admin')->user()->password;
        if (Hash::check($data['currentPassword'], $password)){
            if($data['newPassword']==$data['confirmPassword']){
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => Hash::make($data['newPassword'])]);
                Session::flash('success_message','Your password has been updated successfully !');
                return redirect()->route('admin.settings');
            }else{
                Session::flash('error_message','The new password and confirmation password is not matched');
                return redirect()->route('admin.settings');
            }
        }else{
            Session::flash('error_message','Your current password is incorrect');
            return redirect()->route('admin.settings');
        }
    }

    public function getUpdateAdminDetails(){
        Session::put('page','update-admin-details');
        $admin_id = Auth::guard('admin')->user()->id;
        $admindetails = Admin::where('id',$admin_id)->first();
        return view('admin.admin_update_details',compact('admindetails'));
    }

    public function postUpdateAdminDetails(Request $request){
        $admin_email = Auth::guard('admin')->user()->email;
        $data = $request->all();
        $rules = [
            'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'admin_email' => 'required|email|max:255',
            'admin_type' => 'required',
            'admin_mobile' => 'required|numeric',
            'admin_image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
        $customMessage = [
            'admin_name.required' => 'The name is required',
            'admin_name.alpha' => 'Valid name is required',
            'admin_email.required' => 'Email is required',
            'admin_email.email' => 'Valid email is required',
            'admin_type.required' => 'Type is required',
            'admin_mobile.required' => 'Mobile number is required',
            'admin_mobile.numeric' => 'Valid mobile number is required',
            'admin_image.image' => 'Valid image is required'
        ];
        $this->validate($request,$rules,$customMessage);

        $imageName = null;
        if($request->has('admin_image')){
            $admin_image_path_folder = 'images/admin_images/admin_photos/' . $admin_email; ;
            $admin_name = str_replace(' ','_',$data['admin_email']);
            $image_tmp = $request->file('admin_image');
            if($image_tmp->isValid()){

                File::deleteDirectory($admin_image_path_folder);

                //Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                $imageName = rand() .'.'.$image_tmp->getClientOriginalName();

                //$imagePath =  'images/admin_images/admin_photos/' . $admin_email ;

                if(!File::isDirectory($admin_image_path_folder)){

                    File::makeDirectory($admin_image_path_folder, 0777, true, true);
                }

                $admin_image_path_folder = $admin_image_path_folder . '/' .  $imageName;

                //Upload the image
                Image::make($image_tmp)->resize(300,400)->save($admin_image_path_folder);
            }elseif(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            }
        }else{
            $image = Auth::guard('admin')->user()->image;
            if($image){
                $imageName = $image;
            }else{
                $imageName = '';
            }

        }
        Admin::where('email',$admin_email)->update([
            'name' => $data['admin_name'],
            'mobile' => $data['admin_mobile'],
            'image' => $imageName
        ]);
        Session::flash('success_message','Your details has been updated successfully !');
        return redirect()->route('get.updateAdminDetails');
    }
}
