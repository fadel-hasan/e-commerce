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
    <form action="{{ Route('reset.password.post') }}" method="POST" @class(['auth'])>
        @csrf
        <h2 class="text-2xl font-bold">إستعادة كلمة السر</h2>
        <label for="password">كلمة السر:</label>
        <input type="password" name="password" id="password" placeholder="new password" required>
        <label for="repeatPassword">إعادة كلمة السر:</label>
        <input type="password" name="password_confirmation" id="repeatPassword" placeholder="new password" required>
        {{-- Token account for resrt password account --}}
        <input type="hidden" name="email" id="email" value="admin@gmail.con">
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="submit" value="إستعادة الحساب" id="buttonAuth" disabled>
        <p>
            لا تملك حساباً
            ،يمكنك إنشاء حساب جديد
            <a href="{{ route('get.signup') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
