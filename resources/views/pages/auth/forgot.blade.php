@section('title')
    تسجيل دخول
@endsection
@section('app')
    <form action="{{ Route('forgot') }}" method="POST" @class(['auth', 'forgot'])>
        @csrf
        <h2 class="text-2xl font-bold">إستعادة كلمة السر</h2>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="admin@domain.com" required>
        <input type="submit" value="إستعادة الحساب" id="buttonAuth" disabled>
        <p>
            لا تملك حساباً
            ،يمكنك إنشاء حساب جديد
            <a href="{{ route('signup') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
