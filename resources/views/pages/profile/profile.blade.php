@dd('error')
@section('title', 'الملف الشخصي')
@section('app')
    {{-- Soem Infomation --}}
    <section class="boxs relative mt-6">
        <div class="box">
            <span class="icon"><i class="fa-solid fa-shop"></i></span>
            <div>
                <h3>المدفوعات</h3>
                <p>100$</p>
            </div>
        </div>
        <div class="box">
            <span class="icon"><i class="fa-solid fa-tags"></i></span>
            <div>
                <h3>مرات الشراء</h3>
                <p>5</p>
            </div>
        </div>
        <div class="box">
            <span class="icon"><i class="fa-solid fa-users"></i></span>
            <div>
                <h3>عدد الإحالات</h3>
                <p>150</p>
            </div>
        </div>
        <div class="box">
            <span class="icon"><i class="fa-solid fa-coins"></i></span>
            <div>
                <h3>أرباح الإحالات</h3>
                <p>1520$</p>
            </div>
        </div>
    </section>
    {{-- Refer --}}
    {{-- <h3 class="text-center title-table mt-8">الإحالة</h3>
    <p class="text-center">
        تستطيع ربح 2% من أي عملية شراء من قبل أي شخص تقوم بدعوته للتسجيل في هذا الموقع
    </p>
    <div class="auth min-h-fit relative">
        <input type="text" value="{{ asset('') }}" id="copyLink" disabled>
        <span class="icon-past">
            <div class="fa-solid fa-copy"></div>
        </span>
    </div> --}}
    {{-- Products --}}
    <section id="products" class="scroll-mt-[73px] md:scroll-mt-[80px]">
        <h2 class="text-2xl my-2 text-center title-table">منتاجات قد تعجبك</h2>
        {{--
            -------------------------------------
            مهم
            -------------------------------------
            إذا اشترى أي منج يتم عرض 4 منتجات من القسم الذي اشترى منه و 4 بشكل عشوائي (لترغيبه بشراء هذه المنتجات)
            إذا اشترى أكثر من منتج يتم جلب أكثر منج شراء و3 منتجات من نفس القسم ومنتجان من اقل قسم شراء ومنتجان عشوائيين
            في حال عدم وجود منتج اخر من نفس القسم يتم جلب اخر عشوائي
            --}}
        <div class="products mt-8">
            @for ($i = 0; $i <= 6; $i++)
                <article>
                    <div class="img">
                        <a href="{{ route('user.product', ['uri' => 'test']) }}">
                            <img src="https://placehold.co/600x400.png" alt="العنوان" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="{{ route('user.product', ['uri' => 'test']) }}">
                            <h3>سيرفر رام 4</h3>
                        </a>
                        <p>معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي.
                        </p>
                        <a href="{{ route('user.product', ['uri' => 'test']) }}" class="button-blue">المزيد من المعلومات</a>
                    </div>
                    <a class="category" href="{{ route('user.product', ['uri' => 'test']) }}">سيرفرات</a>
                </article>
            @endfor
        </div>
    </section>
@endsection
@include('pages.home')
