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
    <form action="{{ Route('AdminLogin') }}" method="POST" class="auth">
        @csrf
        <h2 class="text-2xl font-bold">تسجيل الدخول الدخول الى الوحة التحكم</h2>
        <label for="email">البريد الإلكتروني:</label>
        <input type="text" name="email" id="email" placeholder="admin@domain.com" required>
        <label for="password">كلمة السر:</label>
        <input type="password" name="password" id="password" placeholder="**********" required>
        <div class="text-lg">
            <input type="checkbox" class="accent-blue-500" id="checkbox" name="save" />
            <label for="checkbox" class="px-1">تذكرني</label>
        </div>
        <input type="submit" value="تسجيل الدخول" id="buttonAuth" disabled>
        <p>هل نسيت كلمة السر يمكنك إعاداتها <a href="{{ route('forget.password') }}" class="link">من هنا</a>
        </p>
    </form>
@endsection
@extends('pages.home')
