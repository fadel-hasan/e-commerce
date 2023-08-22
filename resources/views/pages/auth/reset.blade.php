@section('title')
    تسجيل دخول
@endsection
@section('app')
    <form action="{{ Route('forgot') }}" method="POST" @class(['auth'])>
        @csrf
        <h2 class="text-2xl font-bold">إستعادة كلمة السر</h2>
        <label for="password">كلمة السر:</label>
        <input type="password" name="password" id="password" placeholder="new password" required>
        <label for="repeatPassword">إعادة كلمة السر:</label>
        <input type="password" name="repeatPassword" id="repeatPassword" placeholder="new password" required>
        {{-- Token account for resrt password account --}}
        <input type="hidden" name="token" value="">
        <input type="submit" value="إستعادة الحساب" id="buttonAuth" disabled>
        <p>
            لا تملك حساباً
            ،يمكنك إنشاء حساب جديد
            <a href="{{ route('signup') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
