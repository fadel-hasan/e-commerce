<nav id="navbarLeft">
    @isset($navbarLinks)
        @foreach ($navbarLinks as $link)
            <a href="{{ $link['to'] }}">
                <span class="icon">
                    <i class="{{ $link['icon'] }}"></i>
                </span>
                <span class="title">{{ $link['title'] }}</span>
            </a>
        @endforeach
    @endisset
    @auth
        <a href="{{ route('logout') }}">
            <span class="icon">
                <i class="fa-solid fa-sign-out rotate-180"></i>
            </span>
            <span class="title">تسجيل خروج</span>
        </a>
    @else
        <a href="{{ route('login') }}">
            <span class="icon">
                <i class="fa-solid fa-sign-out"></i>
            </span>
            <span class="title">تسجيل دخول</span>
        </a>
    @endauth
</nav>
