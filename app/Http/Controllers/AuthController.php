<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // This will load user registration
    public function register(){
        return view('frontend.auth.register');
    }

    // This will save a user
    public function registrationProcess(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:2',
            'confirm_password' => 'required|same:password'
        ]);

        if($validation->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success', 'You have registered successfully');

            return response()->json([
                'success' => true,
                'errors' => []
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validation->errors(),
            ]);
        }
    }


    // This page will load login
    public function login(){
        return view('frontend.auth.login');
    }

    public function authenticate(Request $request){
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->passes()){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return to_route('home');
            }
            else{
                return redirect()->route('login')->with('error', 'Either email or password is incorrect');
            }
        }
        else{
            return redirect()->route('login')->withErrors($validation)->withInput($request->only('email'));
        }
    }


    public function logout(){
        Auth::logout();
        return to_route('login');
    }


    /* ------------------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------------------ */

    public function profile(){
        // Gives the id of user from db
        $id = Auth::user()->id;
        // Gets all record of id that matches first
        $data = User::where('id', $id)->first();
        return view('frontend.auth.profile', compact('data'));
    }

    // This function will update record in profile page
    public function updateProfile(Request $request){
        $id = Auth::user()->id;

        // Email will update if email is new & unique. Otherwise will ignore already logged in email.
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:6|max:20',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ]);

        if($validation->passes()){
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->mobile = $request->mobile;
            $user->save();

            session()->flash('success', 'Profile updated successfully.');
            return response()->json([
                'status' => true,
                'error' => [],
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'errors' => $validation->errors(),
            ]);
        }
    }
}
