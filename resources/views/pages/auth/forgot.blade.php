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
    <form action="{{ Route('forget.password.post') }}" method="POST" @class(['auth', 'forgot'])>
        @csrf
        <h2 class="text-2xl font-bold">إستعادة كلمة السر</h2>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="admin@domain.com" required>
        <input type="submit" value="إستعادة الحساب" id="buttonAuth" disabled>
        <p>
            لا تملك حساباً
            ،يمكنك إنشاء حساب جديد
            <a href="{{ route('get.signup') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
