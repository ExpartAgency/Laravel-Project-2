<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class AdminController extends Controller
{
  public function adminlogin(){
    

    return view('Admin.admin_login');
  }

  public function dashboard(){

    return view('Admin.dashboard');
  }

  public function show_dashboard(Request $request){
    $admin_email=$request->email;
    $admin_password=md5($request->password);
    $result= Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    if ($result) {
      Session::put('admin_id',$result->admin_id);
      Session::put('admin_name',$result->admin_name);
      return redirect::to('/dashboard');

      
    }
    else{
        Session::put ('message','Email or Password Invalid');
        return redirect::to('/admin-login');
      }


  }
}
