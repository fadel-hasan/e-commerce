@section('title')
تسجيل دخول
@endsection
@section('app')
    <form action="{{ Route('login') }}" method="POST" class="auth">
        @csrf
        <h2 class="text-2xl font-bold">تسجيل الدخول</h2>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="admin@domain.com" required>
        <label for="password">كلمة السر:</label>
        <input type="password" name="password" id="password" placeholder="**********" required>
        <div class="text-lg">
            <input type="checkbox" class="accent-blue-500" id="checkbox" name="save" value="true" />
            <label for="checkbox" class="px-1">تذكرني</label>
        </div>
        <input type="submit" value="تسجيل الدخول" id="buttonAuth" disabled>
        <p>
            لا تملك حساباً
            ،يمكنك إنشاء حساب جديد 
            <a href="{{ route('signup') }}" class="link">من هنا</a>
        </p>
        <p>هل نسيت كلمة السر يمكنك إعاداتها <a href="{{ route('forgot') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')