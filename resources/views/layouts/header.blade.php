<header class="bg-slate-100 max-h-[70px] sm:max-h-[77px] min-h-[70px] sm:min-h-[77px] fixed top-0 left-0 w-full z-10">
    <div class="flex justify-between px-2 mx-auto sm:px-2 md:px-4 py-3 items-center md:container">
        <a href="{{ asset('') }}">
            <h1 class="text-xl sm:text-3xl font-bold text-blue-500">عنوان</h1>
        </a>
        <form action="" method="POST" class=" relative basis-[80%] sm:basis-auto md:basis-[60%] lg:basis-[70%]">
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
                        <i class="fa-solid fa-user text-white bg-slate-300 text-2xl p-3 rounded-full"></i>
                    </a>
                </span>
            @endguest
        </div>
    </div>
</header>
