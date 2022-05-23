<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot_password');
    }

    public function processLogin(Request $request)
    {
        $remember = $request->get('remember');
        $arr = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($arr,$remember)){
            session()->flash('success','Đăng nhập thành công');
            $request->session()->regenerate();
            $user = User::query()
                ->where('email',$request->get('email'))
                ->firstOrFail();
            session()->put('id',$user->id);
            session()->put('name',$user->name);
            session()->put('avatar',$user->avatar);
            session()->put('level',$user->level);
            return redirect()->intended('/admin/');
        }
        session()->flash('error','Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }
}
