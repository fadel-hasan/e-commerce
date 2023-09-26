@section('title')
    إنشاء حساب
@endsection
@section('app')
    {{--  If you want view message, You can use alert --}}
    @if (session()->has('success'))
        <x-alert message="{{ session()->get('success') }}" type='success' title="نجاح" />
    @elseif (session()->has('error'))
        @if (is_array(session()->get('error')))
            @foreach (session()->get('error') as $error)
                <x-alert message="{{ $error }}" type='fail' title="خطأ" />
            @endforeach
        @else
            <x-alert message="{{ session()->get('error') }}" type='fail' title="خطأ" />
        @endif
    @endif
    {{--
    @if ($errors->has('repeatPassword'))
        <div>{{ $errors->first('repeatPassword') }}</div>
    @endif --}}
    {{-- <x-alert type="fail" message="فشل التسجيل" /> --}}
    <form action="{{ Route('signup') }}" method="POST" class="auth">
        @csrf
        <h2 class="text-2xl font-bold">إنشاء حساب</h2>
        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" placeholder="الاسم" dir="rtl" required>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="admin@domain.com" required>
        <label for="password">كلمة السر:</label>
        <div class="relative">
            <input type="password" name="password" id="password" placeholder="**********" required>
            <span class="icon-eye">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        <label for="repeatPassword">إعادة كلمة السر:</label>
        <div class="relative">
            <input type="password" name="password_confirmation" id="repeatPassword" placeholder="********" required>
            <span class="icon-eye">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        <input type="submit" value="إنشاء حساب" id="buttonAuth" disabled>
        <p>
            تملك حساباً
            ،يمكنك تسجيل الدخول
            <a href="{{ Route('get.login') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
