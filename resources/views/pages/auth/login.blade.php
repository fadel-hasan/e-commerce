@section('title')
    تسجيل دخول
@endsection
@section('app')
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
    <form action="{{ Route('login') }}" method="POST" class="auth">
        @csrf
        <h2 class="text-2xl font-bold">تسجيل الدخول</h2>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="example@domain.com" required>
        <label for="password">كلمة السر:</label>
        <div class="relative">
            <input type="password" name="password" id="password" placeholder="**********" required>
            <span class="icon-eye">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        <div class="text-lg">
            <input type="checkbox" class="accent-blue-500" id="checkbox" name="save" value="true" />
            <label for="checkbox" class="px-1">تذكرني</label>
        </div>
        <input type="submit" value="تسجيل الدخول" id="buttonAuth" disabled>
        <p>
            لا تملك حساباً
            ،يمكنك إنشاء حساب جديد
            <a href="{{ route('get.signup') }}" class="link">من هنا</a>
        </p>
        <p>هل نسيت كلمة السر يمكنك إعاداتها <a href="{{ route('forget.password') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
