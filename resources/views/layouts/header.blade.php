<header id="header">
    <div>
        <a href="{{ asset('') }}">
            <h1>{{ \App\Http\Controllers\Site\VarController::getSitting('title') }}</h1>
        </a>
        <form action="" method="POST" class="">
            <input type="serach" name="q" id="inputSearch">
            <span id="iconSearch"><i class="fa-solid fa-search"></i></span>
        </form>
        {{-- i used guest to check if not registerd --}}
        <div @class(['hidden sm:block'])>
            @guest
                <a href="{{ route('login') }}" class="button-blue">تسجيل الدخول</a>
            @else
                <span>
                    <a href="{{ route('user.profile') }}">
                        <i class="fa-solid fa-user profile-img"></i>
                    </a>
                </span>
            @endguest
        </div>
    </div>
</header>
