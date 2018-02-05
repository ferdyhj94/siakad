<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Redirect;
use Auth;
class LoginController extends Controller
{
	function login(){
		return view('welcome');
	}

	function postLogin(Request $request){
        if (User::where('email', '=', $request->input('email'))->exists()) {
        	if(Auth::attempt(['email'=> $request->input('email'),'password'=>$request->input('password')]))
    	{
    		if(Auth::user()->user_role=="Wali"){
    		return redirect('wali');
            
    	}
        else if(Auth::user()->user_role=="Admin"){
        return redirect('admin');
     }else if(Auth::user()->user_role=="Kepsek"){
     	return redirect('kepsek');
         }
     }else{
        return redirect('login')->with('message','Username atau password salah!');
     }
    }else{
    		return redirect('login')->with('message','Username belum terdaftar!');
    	}
    }

    public function registerView(){
       return view('auth.register');
               
    }

    function register(){
        return view('auth.register');
    }

    public function postRegister(Request $request){
    	
    		if (User::where('email', '=', $request->email)->exists()) {
    			return Redirect::to('register')->with('message','E-mail sudah terdaftar!');
    		}else{
    		$password = bcrypt($request->password);
    		$data = new User();
    		$data->name = $request->name;
    		$data->email = $request->email;	
    		$data->password = $password;
    		$data->user_role = 'Admin';
    		$data->save();
    		return redirect('login')->with('message','Berhasil mendaftar!');
    		}
        
    }

        public function registerAdmin(Request $request){
        
            if (User::where('email', '=', $request->email)->exists()) {
                return Redirect::to('register')->with('message','E-mail sudah terdaftar!');
            }else{
            $password = bcrypt($request->password);
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email; 
            $data->password = $password;
            $data->user_role = 'Admin';
            $data->save();
            return redirect('login')->with('message','Berhasil mendaftar sebagai admin!');
            }
        
    }    

    public function logout(Request $request){
    	Auth::logout();
    	return redirect('login');
    }
}
