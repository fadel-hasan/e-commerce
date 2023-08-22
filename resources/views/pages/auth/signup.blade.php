@section('title')
إنشاء حساب
@endsection
@section('app')
    {{--  If you want view message, You can use alert --}}
    <x-alert message="تم تسججيل الدخحول" />
    <x-alert type="fail" message="فشل التسجيل" />
    <form action="{{ Route('signup') }}" method="POST" class="auth">
        @csrf
        <h2 class="text-2xl font-bold">إنشاء حساب</h2>
        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" placeholder="الاسم" dir="rtl" required>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="admin@domain.com" required >
        <label for="password">كلمة السر:</label>
        <input type="password" name="password" id="password" placeholder="**********" required>
        <div class="text-lg">
            <input type="checkbox" class="accent-blue-500" id="checkbox" name="save" value="true" />
            <label for="checkbox" class="px-1">تذكرني</label>
        </div>
        <input type="submit" value="تسجيل الدخول" id="buttonAuth" disabled>
        <p>
            تملك حساباً
            ،يمكنك تسجيل الدخول 
            <a href="{{ Route('login') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')