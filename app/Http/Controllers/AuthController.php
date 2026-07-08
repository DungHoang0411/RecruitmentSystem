<?php

namespace App\Http\Controllers;

use App\Events\CandidateRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:64',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed'
            ],
            'terms' => 'accepted'
        ], [
            'password.regex' => 'Mật khẩu tối thiểu 8 ký tự, có ít nhất 1 chữ hoa và 1 chữ số',
            'email.unique' => 'VALIDATION_ERROR'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate'
        ]);

        $token = Str::random(64);

        DB::table('email_verify_tokens')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        event(new CandidateRegistered($user, $token));

        return redirect()->route('login')->with('success', 'Tạo tài khoản thành công. Vui lòng kiểm tra email để xác thực.');
    }

    public function verifyEmail($token)
    {
        $record = DB::table('email_verify_tokens')->where('token', $token)->first();

        if (!$record) {
            return redirect()->route('login')->with('error', 'Token không tồn tại hoặc đã được sử dụng.');
        }

        if (Carbon::parse($record->created_at)->addHours(48)->isPast()) {
            return redirect()->route('login')->with('error', 'Token đã hết hạn. Vui lòng yêu cầu gửi lại email xác nhận.');
        }

        $user = User::where('email', $record->email)->first();

        if ($user) {
            $user->update(['email_verified_at' => Carbon::now()]);
            DB::table('email_verify_tokens')->where('email', $user->email)->delete();
            return redirect()->route('login')->with('success', 'Xác minh email thành công. Bạn có thể đăng nhập ngay bây giờ.');
        }

        return redirect()->route('login')->with('error', 'Đã xảy ra lỗi.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->status === 'banned') {
            return back()->with('error', 'Tài khoản này đã bị ban');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'candidate') {
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->with('error', 'Tài khoản sai email hoặc mật khẩu');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
