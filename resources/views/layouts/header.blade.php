<header class="bg-slate-100 max-h-[70px] sm:max-h-[77px] min-h-[70px] sm:min-h-[77px]">
    <div class="flex justify-between px-2 mx-auto sm:px-2 md:px-4 py-3 items-center md:container">
        <a href="{{ asset('') }}">
            <h1 class="text-xl sm:text-3xl font-bold text-blue-500">عنوان</h1>
        </a>
        <form action="" method="POST" class=" relative basis-[80%] sm:basis-auto     md:basis-[60%] lg:basis-[70%]">
            <input type="serach" name="q" id="inputSearch">
            <span id="iconSearch"><i class="fa-solid fa-search"></i></span>
        </form>
        {{-- You Can use any ways for $isAuth --}}
        <div @class(['hidden sm:block'])>
            <a href="{{ route('login') }}" @class(['hidden' => $isAuth,'text-md sm:text-lg md:text-xl button-blue'])>تسجيل الدخول</a>
            <span @class(['hidden' => !$isAuth])>
                <a href="#">
                    <i class="fa-solid fa-user text-white bg-slate-300 text-2xl p-3 rounded-full"></i>
                </a>
            </span>
        </div>
    </div>
</header>