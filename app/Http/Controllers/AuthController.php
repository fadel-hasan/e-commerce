<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function getSignup()
    {
        return view('pages.auth.signup');
    }
    public function getLogin()
    {
        return view('pages.auth.login');
    }
    public function postSignup(Request $r)
    {
        $ValidateRules = [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required'
        ];
        $ValidatorErrors = [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'الاسم يجب ان لا يقل عن حرفين',
            'name.max' => 'الاسم يجب ان لايزيد عن 255 حرف',
            'email.required' => 'رجاء أدخل الايميل',
            'email.email' => 'ايميل غير صحيح',
            'email.unique' => 'هذا الايميل مستخدم',
            'password.required' => 'كلمة السر مطلوبة',
            'password.min' => 'كلمة السر قصيرة جدا',
            'password.max' => 'كلمة السر طويلة جدا',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'password_confirmation.required' => 'يرجى إعادة إدخال كلمة المرور.',
        ];
        $validatedData = Validator::make($r->all(), $ValidateRules, $ValidatorErrors);

        if ($validatedData->fails()) {
            // dd($validatedData->failed());
            return redirect(route('get.signup'))->with('error', $validatedData->errors()->all());
        } else {
            $HashedPassword = Hash::make($r->password);
            $date['name'] = $r->name;
            $date['email'] = $r->email;
            $date['password'] = $HashedPassword;
            $User = User::create($date);
            // dd($User);
            if (!$User) {
                return redirect(route('get.signup'))->with('error', 'معلومات التسجيل خاطئة');
            }
            return redirect(route('get.login'))->with('success', 'تم التسجيل قم بادخال بريدك وكلمة المرور للدخول');
        }
    }

    public function postLogin(LoginRequest $r)
    {

        $remember_me = $r->has('save') ? true : false;
        if (auth()->attempt(['email' => $r->email, 'password' => $r->password], $remember_me)) {
            return redirect()->intended(route('home'));
        } else {
            return redirect(route('get.login'))->with('error', 'معلومات تسجيل دخول خاطئة حاول مرة اخرى');
        }
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('home');
    }

    public function forgetPassword()
    {
        return view('pages.auth.forgot');
    }

    public function forgetPasswordPost(Request $r)
    {
        $r->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $r->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forgot", ['token' => $token], function ($massage) use ($r) {
            $massage->to($r->email);
            $massage->subject("Reset Password");
        });

        return redirect()->to(route('forget.password'))->with('success', 'تم ارسال رسالة لبريدك لإعادة تعيين كلمة السر');
    }

    public function resetPassword($token)
    {
        return view('pages.auth.reset', compact('token'));
    }

    public function resetPasswordPost(Request $r)
    {
        $r->validate([
            "email" => "required|email|exists:users",
            "password" => "required|min:8|max:255|confirmed",
            "password_confirmation" => "required"
        ]);
        $updatePassword = DB::table('password_reset_tokens')->where([
            "email" => $r->email,
            "token" => $r->token
        ])->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset.password'))->with('Error', 'خطأ الرجاء المحاولة لاحقا');
        } else {

            if (strtotime($updatePassword->created_at) >= (time() - 1800)) {
                User::where("email", $r->email)->update(["password" => Hash::make($r->password)]);
                DB::table("password_reset_tokens")->where(["email" => $r->email])->delete();
                return redirect()->to(route('get.login'))->with('success', 'تم اعادة تعيين كلمة المرور');
            } else {
                DB::table("password_reset_tokens")->where(["email" => $r->email])->delete();
                return redirect()->to(route('get.login'))->with('error', 'عذرا لقد فات الأوان');
            }
        }
    }
}
