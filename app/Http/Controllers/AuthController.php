<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as r;


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
            $ip = (env('APP_URL') == 'http://localhost') ? '211.197.11.0' : r::ip();
            $date['ip'] = $ip;
            $token = env("IPINFO_SECRET");
            $url = "ipinfo.io/$ip?token=$token";
            $response = Http::timeout(20)->get($url);
            $jsonData = $response->json();
            $date['country'] = ($jsonData['city'] ?? 'other');
            $User = User::create($date);

            if (!$User) {
                return redirect(route('get.signup'))->with('error', 'معلومات التسجيل خاطئة');
            }
            
            $User->update([
                'referral_code' => uniqid($User->id)
            ]);

            if ($r->referral_code) {
                $referrer = User::where('referral_code', $r->referral_code)->first();
                if ($referrer) {
                    DB::table('referrals')->insert(
                        [
                            'referrer_id' => $referrer->id,
                            'referred_id' => $User->id,
                        ]
                        );
                }
            }

            $token = Str::random(64);

            UserVerify::create([
                'user_id' => $User->id,
                'token' => $token
            ]);

            Mail::send('emails.emailVerification', ['token' => $token], function ($message) use ($r) {
                $message->to($r->email);
                $message->subject('Email Verification Mail');
            });
            // dd($User);
            return redirect(route('get.login'))->with('success', 'تم التسجيل بنجاح تم ارسال رسالة لبريدك الالكتروني لتأكيد البريد الإلكتروني');
        }
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'المعذرة لا يمكن التعرف على البريد الإلكتروني الخاص بك';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "تم التحقق من البريد الإلكتروني الخاص بك. يمكنك الآن تسجيل الدخول.";
            } else {
                $message = "لقد تم التحقق من بريدك الإلكتروني بالفعل. يمكنك الآن تسجيل الدخول";
            }
        }

      return redirect()->route('get.login')->with('message', $message);
    }


    public function postLogin(LoginRequest $r)
    {
        $admin = DB::table('roles')->where('name', 'admin')->value('id');

        $remember_me = $r->has('save') ? true : false;
        if (auth()->attempt(['email' => $r->email, 'password' => $r->password], $remember_me)) {
            if (auth()->user()->role_id == $admin) {
                return redirect()->route('dashboard');
            }
            if(session()->has('useurl'))
            {
                // dd(true);
                $uri = session()->get('useurl');
                session()->forget('useurl');
                return redirect()->intended(route('user.product',['uri'=>$uri]));

            }
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
