<header id="header">
    <div>
        <a href="{{ asset('') }}">
            <h1>{{ \App\Http\Controllers\Site\VarController::getSitting('title') }}</h1>
        </a>
        <div class="form">
            <input type="serach" name="q" id="inputSearch">
            <span id="iconSearch"><i class="fa-solid fa-search"></i></span>
        </div>
        {{-- i used guest to check if not registerd --}}
        <div class="hidden sm:block relative">
            @guest
                <a href="{{ route('login') }}" class="button-blue">تسجيل الدخول</a>
            @else
                <span id="img-profile" class="cursor-pointer">
                    <i class="fa-solid fa-user profile-img"></i>
                </span>
                <nav class="dropdaown">
                    <a href="{{ route('user.history') }}">السجلات</a>
                    @if (isset(auth()->user()->role_id) and auth()->user()->role_id != 2)
                        <a href="{{ route('dashboard') }}">لوحة التحكم</a>
                    @endif
                    <a href="{{ route('logout') }}">تسيجيل خروج</a>
                </nav>
            @endguest
        </div>
    </div>
</header>
