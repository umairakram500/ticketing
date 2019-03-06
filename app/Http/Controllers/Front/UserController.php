<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\DoRegister;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    public function index()
    {

        if (Auth::check()) {
            return redirect()->route('front.user.dashboard');
        } else {
            return view('front.user.login');
        }
    }

    public function login()
    {
        return view('front.user.login');

    }

    public function loginProcess(Request $request)
    {
        if($request->email == '' || $request->password == '')
        {
            return redirect()->back()->with("flash_error","Email and Password are required");
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->route('front.user.dashboard')->with("flash_success","Successfully logged in.");
        }
        else {
            return redirect()->back()->with("flash_error","Email or Password not valid.");
        }
    }

    public function register()
    {
        return view('front.user.register');
    }

    public function registerProcess(DoRegister $request)
    {
        $user = new User();
        $user->name = $request->name;
        //$user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if($user->save()){
            return redirect()->route('front.login')->with('flash_success', 'User Register Successfully.');
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('front.home');
    }

    public function profile()
    {
        return view('front.user.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with("flash_success","Profile updated successfully.");
    }

    public function dashboard()
    {
        //$data = Auth::user()->tickets()->count();
        //dd($data);
        return view('front.user.dashboard');
    }

    public function resetpass()
    {
        return view('front.user.resetpass');
    }
    public function resetpassword(Request $request)
    {
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required',
            'repass' => 'required|same:newpass',
        ]);

        if(Hash::check($request->oldpass, Auth::user()->password))
        {
            $user = Auth::user();
            $user->password = bcrypt($request->newpass);
            $user->save();
            return redirect()->back()->with("flash_success","Password updated successfully");
        }
        else {
            return redirect()->back()->with("flash_error","Old password not mathch.");
        }
    }

}
