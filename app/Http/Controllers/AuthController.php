<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function logout()
    {
//        session()->flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function processLogin(Request $request)
    {
        $remember = $request->has('remember');
//        dd($remember);
        $arr = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($arr,$remember)){
            session()->flash('success','Đăng nhập thành công');
            $user = User::query()
                ->where('email',$request->get('email'))
                ->firstOrFail();
            Auth::login($user, $remember);
            return redirect()->intended('/admin/');
        }
        session()->flash('error','Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot_password');
    }

    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'email' =>'required|email|exists:users',
        ],[
            'email.email'=>'Vui lòng nhập lại địa chỉ email',
            'email.required'=>'Vui lòng nhập lại địa chỉ email',
            'email.exists'=>'Vui lòng nhập lại địa chỉ email',
        ]);
            $token = 'user_' . Str::random(10);
            User::Where(['email' =>$request->get('email')])->update(['token'=>$token]);
            $user = User::Where(['email' =>$request->get('email')])->first();
            Mail::send('admin.auth.send_mail',compact('user'),function ($email) use ($user) {
                $email->subject('Nhà Xe Thu Đức - Lấy lại mật khẩu');
                $email->to($user->email,$user->name);
            });
            return redirect()->route('admin.login')->with('success','Vui lòng kiểm tra email để đổi mật khẩu !!!');
    }

    public function resetPassword(Request $request)
    {
        $token = $request->token;

        $user = User::Where(['token' =>$token])->first();
        if(!$user){
            return redirect()->route('admin.login')->with('error','Lỗi không xác định vui lòng thử lại sau');
        }
        return view('admin.auth.reset_password',['token' =>$token]);
    }

    public function processResetPassword(Request $request)
    {
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password',
            'token'=>'required',
        ],[
            'password.required'=>'Mật khẩu không được bỏ trống',
            'confirm_password.required'=>'Mật khẩu nhập không được bỏ trống',
            'confirm_password.same'=>'Mật khẩu nhập không giống nhau',
            'token.required'=>'Lỗi không xác định vui lòng thử lại',
        ]);
        $password = Hash::make($request->get('password'));
        User::where(['token'=>$request->get('token')])->update([
            'password'=>$password,
            'token'=>null,
        ]);
        return redirect()->route('admin.login')->with('success','Đổi mật khẩu thành công !!!');
    }
}
